<?php

use app\config\Config;

class CtrlORessourceGenerator
{
  static $path_oressource = "../../oressource/";

  function index(Base $f3)
  {
    echo View::instance()->render('/home.html.php');
  }

  function demarrer(Base $f3)
  {
    echo View::instance()->render('/demarrer.html.php');
  }

  function selfhost(Base $f3)
  {
    echo View::instance()->render('/selfhost.html.php');
  }

  function webhost(Base $f3)
  {
    echo View::instance()->render('/webhost.html.php');
  }

  function create(Base $f3)
  {
    $f3->set('from_backup', $f3->get('GET.from_backup'));
    echo View::instance()->render('/create.html.php');
  }

  function generate(Base $f3)
  {
    $f3->set('SESSION', $this->verifyAndCleanData($f3->get('POST')));
    $f3->set('SESSION.departement', substr($f3->get('SESSION.codePostal'), 0, 2));

    try {
      $this->createDatabaseAndFolder($f3);
    } catch (Exception $e) {
      \Flash::instance()->addMessage("Erreur : ".$e->getMessage(), 'danger');
      return $f3->reroute('/create');
    }
    return $f3->reroute('/visualisation');
  }

  function verifyAndCleanData($data)
  {
    $ret = array();
    $ret['nomRessourcerie'] = htmlspecialchars($data['nomRessourcerie']);
    $ret['nomRessourcerie_base'] = Web::instance()->slug($ret['nomRessourcerie']);
    $ret['adresseRessourcerie'] = htmlspecialchars($data['adresseRessourcerie']);
    $ret['codePostal'] = filter_var($data['codePostal'], FILTER_SANITIZE_NUMBER_INT);
    $ret['ville'] = htmlspecialchars($data['ville']);
    $ret['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $ret['motDePasse'] = $data['motDePasse'];

    return $ret;
  }

  function createDatabaseAndFolder($f3)
  {
    $host = Config::getInstance()->get('host');
    $root = Config::getInstance()->get('root');
    $root_passwd = Config::getInstance()->get('root_passwd');
    $db_name = $f3->get('SESSION.departement').'_'.$f3->get('SESSION.nomRessourcerie_base');
    if ($this->instanceIsUnique($f3, $db_name)) {
      $data['host'] = '$host = "localhost";';
      $data['port'] = '$port = "3306";';
      $data['base'] = '$base = "' . $db_name.'";';
      $data['user'] = '$user = "' . $db_name.'";';
      $pass = md5(uniqid(date('dmY').$db_name.rand(0, 10000)));
      $data['pass'] = '$pass = "'. $pass.'";';
      if (! symlink('../../oressource', './'.$db_name)) {
        throw new \Exception("Erreur de lien symbolique", 1);
      }
      file_put_contents($path_oressource.'config/config_' . $db_name . '.php',
"<?php

"
      );
      foreach($data as $value) {
        file_put_contents($path_oressource.'config/config_' . $db_name . '.php', $value."\n", FILE_APPEND);
      }
    } else {
      throw new \Exception("Une instance existe déjà pour cette ressourcerie", 1);
    }

    try {
      $user = $db_name;

      $dbh = new PDO("mysql:host=".$host, $root, $root_passwd);

      $sql = $dbh->prepare("CREATE DATABASE IF NOT EXISTS `$db_name`");
      $sql->execute();

      $sql = $dbh->prepare("CREATE USER :user@localhost IDENTIFIED BY :pass;");
      $sql->execute(array(':user' => $user, ':pass' => $pass));

      $sql = $dbh->prepare("GRANT SELECT, INSERT, UPDATE, DELETE ON `$db_name`.* TO :user@'localhost' IDENTIFIED BY :pass;");
      $sql->execute(array(':user' => $user, ':pass' => $pass));
    } catch (PDOException $e) {
      throw new \Exception($e->getMessage(), 1);
    }

    $backup = $f3->get('POST.backupInput') ?? $path_oressource.'mysql/oressource.sql';
    if (! $this->loadDataInDatabase($f3, $backup, $db_name, $user, $pass)) {
      throw new \Exception("Erreur au chargement de la sauvegarde");
    }
  }

  function instanceIsUnique($f3, $db_name)
  {
    return ! is_dir('./'. $db_name);
  }

  function loadDataInDatabase($f3, $backup, $db_name, $user, $pass)
  {
    $host = Config::getInstance()->get('host');
    $root = Config::getInstance()->get('root');
    $root_passwd = Config::getInstance()->get('root_passwd');
    $dsn = "mysql:dbname=".$db_name.";host=".$host;
    $dbh = new PDO($dsn, $root, $root_passwd);

    if (! $dbh->query(file_get_contents($backup))) {
      return false;
    }

    $sql = $dbh->prepare("
    INSERT INTO utilisateurs
    (id, timestamp, niveau, nom, prenom, mail, pass, id_createur, id_last_hero, last_hero_timestamp)
    VALUES
    (:id, :timestamp, :niveau, :nom, :prenom, :mail, :pass, :id_createur, :id_last_hero, :last_hero_timestamp)
    ");

    if (! $sql->execute([
      ':id'         => 1,
      ':timestamp' => date('Y-m-d H:i:s'),
      ':niveau'       => 'c1c2c3v1v2v3s1bighljk',
      ':nom'       => 'administrateur.ice',
      ':prenom'     => 'oressource',
      ':mail'      => $f3->get('SESSION.email'),
      ':pass' => md5($f3->get('SESSION.motDePasse')),
      ':id_createur'      => 1,
      ':id_last_hero'    => 1,
      ':last_hero_timestamp' => date('Y-m-d H:i:s'),
    ])) {
      return false;
    }

    return true;
  }

  function visualisation(Base $f3)
  {
    echo View::instance()->render('/visualisation.html.php');
  }

  function redirectToInstance(Base $f3)
  {
    return $f3->reroute($f3->get('SESSION.departement').'_'.$f3->get('SESSION.nomRessourcerie_base'));
  }
}

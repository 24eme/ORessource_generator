<?php

use app\config\Config;

class CtrlORessourceGenerator
{
  function index(Base $f3)
  {
    echo View::instance()->render('/home.html.php');
  }

  function demarrer(Base $f3)
  {
    $f3->set('content', 'demarrer.html.php');
    echo View::instance()->render('/layout.html.php');
  }

  function selfhost(Base $f3)
  {
    $f3->set('content', 'selfhost.html.php');
    echo View::instance()->render('/layout.html.php');
  }

  function webhost(Base $f3)
  {
    $f3->set('content', 'webhost.html.php');
    echo View::instance()->render('/layout.html.php');
  }

  private function getDBH(Base $f3, $dbname = null, $user = null, $passwd = null) {
      $host = Config::getInstance()->getDBHost();
      $port = Config::getInstance()->getDBPort();
      if (!$user) {
          $user = Config::getInstance()->getDBRoot();
      }
      if (!$passwd) {
          $passwd = Config::getInstance()->getDBRootPassword();
      }
      $pdo_schema = "mysql:host=".$host.";port=".$port;
      if ($dbname) {
          $pdo_schema .= ';dbname='.$dbname;
      }
      $dbh = new PDO($pdo_schema, $user, $passwd);
      return $dbh;
  }

  function create(Base $f3)
  {

    $dbh = $this->getDBH($f3);
    $db_name = $f3->get('SESSION.db_name');
    $sql = $dbh->prepare("use `$db_name`");
    try {
        $sql->execute();
        $error = true;
    } catch (Exception $e) {
        $error = false;
    }
    if ($db_name) {
      if ($error == true) {
        $f3->reroute('/validation');
      }
    }
    $f3->set('from_backup', $f3->get('GET.from_backup'));
    $f3->set('content', 'create.html.php');
    echo View::instance()->render('/layout.html.php');
  }

  function dataCheck(Base $f3)
  {
    try {
      $f3->set('SESSION', $this->verifyAndCleanData($f3));
      $f3->set('SESSION.departement', substr($f3->get('SESSION.codePostal'), 0, 2));
      $f3->set('SESSION.db_name', $f3->get('SESSION.departement').'_'.$f3->get('SESSION.nomRessourcerie_base'));
      $this->verifyDatabaseAndFolder($f3);
    } catch (Exception $e) {
      \Flash::instance()->addMessage("Erreur : ".$e->getMessage(), 'danger');
      return $f3->reroute('/create');
    }
    return $f3->reroute('/visualisation');
  }

  function verifyAndCleanData($f3)
  {
    $ret = array();
    $data = $f3->get('POST');
    $ret['nomRessourcerie'] = htmlspecialchars($data['nomRessourcerie']);
    $ret['nomRessourcerie_base'] = Web::instance()->slug($ret['nomRessourcerie']);
    $ret['adresseRessourcerie'] = htmlspecialchars($data['adresseRessourcerie']);
    $ret['codePostal'] = filter_var($data['codePostal'], FILTER_SANITIZE_NUMBER_INT);
    $ret['ville'] = htmlspecialchars($data['ville']);
    $ret['emailRessourcerie'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $ret['motDePasse'] = $data['motDePasse'];
    if($data['motDePasse'] != $data['motDePasseRepetition']) {
        throw new Exception("Les 2 mots de passe ne sont pas identique.");
    }
    if ($_FILES['backupInput']['name']) {
      if (pathinfo($_FILES['backupInput']['name'], PATHINFO_EXTENSION) != 'sql') {
        throw new \Exception("Le fichier de sauvegarde déposé n'est pas un fichier sql", 1);
      }
      $ret['from_backup'] = $_FILES['backupInput']['name'];
      move_uploaded_file($_FILES["backupInput"]["tmp_name"], $f3->get('UPLOADS') . $_FILES["backupInput"]["name"]);
      $ret['backupInput'] = $f3->get('UPLOADS') . $f3->get('FILES.backupInput.name');
    }
    return $ret;
  }

  function verifyDatabaseAndFolder($f3)
  {
    $db_name = $f3->get('SESSION.db_name');
    try {
        $dbh = $this->getDBH($f3, $db_name);
    } catch (Exception $e) {
        $dbh = null;
    }
    if ($dbh) {
      throw new \Exception("Une base de donnée existe déjà pour cette ressourcerie", 1);
    }

    if (! $this->instanceIsUnique($f3, $db_name)) {
      throw new \Exception("Une instance existe déjà pour cette ressourcerie", 1);

    }
    if (! is_dir(Config::getInstance()->getORessourcePath())) {
      throw new \Exception("Le dossier ORessource est introuvable", 1);
    }
  }

  function instanceIsUnique($f3, $db_name)
  {
    return ! is_dir('./'. $db_name);
  }

  function visualisation(Base $f3)
  {
    $f3->set('content', 'visualisation.html.php');
    echo View::instance()->render('/layout.html.php');
  }

  function generate(Base $f3)
  {
    $data['host'] = '$host = "'.Config::getInstance()->getDBHost().'";';
    $data['port'] = '$port = "'.Config::getInstance()->getDBPort().'";';
    $data['base'] = '$base = "' . $f3->get('SESSION.db_name').'";';
    $data['user'] = '$user = "' . $f3->get('SESSION.db_name').'";';
    $pass = md5(uniqid(date('dmY').$f3->get('SESSION.db_name').rand(0, 10000)));
    $data['pass'] = '$pass = "'. $pass.'";';
    try {
      clearstatcache(true);
      if (! symlink(Config::getInstance()->getORessourcePath(), './'.$f3->get('SESSION.db_name'))) {
        throw new \Exception("Erreur à la création du lien symbolique", 1);
      }
      $this->createConfig($f3, $data);
      $this->createDatabase($f3, $f3->get('SESSION.db_name'), $pass);
      if (Config::getInstance()->getMailFrom()) {
          $message = "<html><body></body></html>";
          $headers = array(
            'From' => Config::getInstance()->getMailFrom(),
            'Reply-To' => Config::getInstance()->getMailFrom(),
            'X-Mailer' => 'PHP/'.phpversion(),
            'MIME-Version' => '1.0',
            'Content-type' => 'text/html; charset=iso-8859-1'
          );
          if (! mail('tale-fau@24eme.fr', "Vos informations de connexion", $message, $headers)) {
            throw new \Exception("Erreur à l'envoi du mail de confirmation");
          }
      }
    } catch (Exception $e) {
      \Flash::instance()->addMessage("Erreur : ".$e->getMessage(), 'danger');
      return $f3->reroute('/visualisation');
    }

    return $f3->reroute('/validation');
  }

  function createConfig($f3, $data)
  {
    $config_path = Config::getInstance()->getORessourcePath().'/config';
    if (! is_dir($config_path)) {
        mkdir($config_path);
    }
    $config_path .= '/config/config_' . $f3->get('SESSION.db_name') . '.php';

    if (! file_put_contents($config_path, "<?php\n\n")) {
        throw new Exception("Erreur au chargement initial du fichier de config");
        return ;
    }
    foreach($data as $value) {
      if (! file_put_contents($config_path, $value."\n", FILE_APPEND)) {
        throw new Exception("Erreur au chargement des info de l'instance dans le fichier de config");
        return ;
      }
    }
  }

  function createDatabase($f3, $db_name, $pass)
  {
    $user = $db_name;

    $dbh = $this->getDBH($f3);

    $sql = $dbh->prepare("CREATE DATABASE `$db_name`");
    $sql->execute();

    $sql = $dbh->prepare("CREATE USER :user@localhost IDENTIFIED BY :pass;");
    $sql->execute(array(':user' => $user, ':pass' => $pass));

    $sql = $dbh->prepare("GRANT SELECT, INSERT, UPDATE, DELETE ON `$db_name`.* TO :user@'localhost' IDENTIFIED BY :pass;");
    $sql->execute(array(':user' => $user, ':pass' => $pass));

    if ($f3->get('SESSION.from_backup') && $f3->get('SESSION.backupInput')) {
      $backup = $f3->get('SESSION.backupInput');
    } else {
      $backup = $f3->get('ROOT').'/data/oressource_schema.sql';
    }
    if (! $this->loadDataInDatabase($f3, $backup, $f3->get('SESSION.db_name'), $user, $pass)) {
      throw new \Exception("Erreur au chargement de la sauvegarde");
    }
  }

  function loadDataInDatabase($f3, $backup, $db_name, $user, $pass)
  {
    $dbh = $this->getDBH($f3);

    $search = ['NOM_RESSOURCERIE', 'ADRESSE_RESSOURCERIE', 'MAIL_RESSOURCERIE', 'VILLE_RESSOURCERIE', 'DATE_CREATION'];
    $replace = [$f3->get('SESSION.nomRessourcerie'), $f3->get('SESSION.adresseRessourcerie'), $f3->get('SESSION.emailRessourcerie'), $f3->get('SESSION.ville'), date('Y-m-d H:i:s')];
    if (! $dbh->query(str_replace($search, $replace, file_get_contents($backup)))) {
      return false;
    }

    $dbh->beginTransaction();
    $sql_user = "INSERT INTO `utilisateurs` (`timestamp`, `niveau`, `nom`, `prenom`, `mail`, `pass`, `id_createur`, `id_last_hero`, `last_hero_timestamp`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s');";
    if (! $dbh->query(sprintf($sql_user, date('Y-m-d H:i:s'), 'c1c2c3v1v2v3s1s2s3bighljk', 'administrateur.ice', 'oressource', $f3->get('SESSION.emailRessourcerie'), md5($f3->get('SESSION.motDePasse')), 1, 1, date('Y-m-d H:i:s')))) {
      return false;
    }
    $dbh->commit();

    return true;
  }

  function validation(Base $f3)
  {
    $f3->set('content', 'validation.html.php');
    echo View::instance()->render('/layout.html.php');
  }
}

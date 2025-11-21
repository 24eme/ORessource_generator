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

  function contact(Base $f3)
  {
    $f3->set('content', 'contact.html.php');
    echo View::instance()->render('/layout.html.php');
  }

  function apropos(Base $f3)
  {
    $f3->set('content', 'apropos.html.php');
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

  private function dbExists(Base $f3, $db_name) {
      $dbh = $this->getDBH($f3);
      $sql = $dbh->prepare("use `$db_name`");
      try {
          $sql->execute();
          return true;
      } catch (Exception $e) {
          return false;
      }
  }

  function create(Base $f3)
  {
    $db_name = $f3->get('SESSION.db_name');
    $error = $this->dbExists($f3, $db_name);
    if ($db_name) {
      if ($error == true) {
        if (file_exists(Config::getInstance()->getORessourcePath().'/'.$f3->get('SESSION.instance_name'))) {
            return $f3->reroute('/validation');
        }
      }
    }
    $f3->set('from_backup', $f3->get('GET.from_backup'));
    $f3->set('content', 'create.html.php');
    echo View::instance()->render('/layout.html.php');
  }

  function dataCheck(Base $f3)
  {
    try {
      if ($f3->get('POST.accronyme') != 'RNRR') {
        throw new Exception('Erreur de Capchta');
      }
      $f3->set('SESSION', $this->verifyAndCleanData($f3));
      $f3->set('SESSION.departement', substr($f3->get('SESSION.codePostal'), 0, 2));
      $f3->set('SESSION.db_name', 'oressource_'.$f3->get('SESSION.departement').'_'.$f3->get('SESSION.nomRessourcerie_base'));
      $f3->set('SESSION.instance_name', $f3->get('SESSION.departement').'_'.$f3->get('SESSION.nomRessourcerie_base'));
      $this->verifyDatabaseAndFolder($f3);
    } catch (Exception $e) {
      \Flash::instance()->addMessage("Erreur : ".$e->getMessage(), 'danger');
      return $f3->reroute('/create');
    }
    return $f3->reroute('/visualisation');
  }

  public static function cleanInput($s) {
      $s = preg_replace('/<[^>]*>/', '', $s);
      $s = str_replace(';', '', $s);
      return $s;
  }

  function verifyAndCleanData($f3)
  {
    $ret = array();
    $data = $f3->get('POST');
    $ret['nomRessourcerie'] = self::cleanInput($data['nomRessourcerie']);
    $ret['nomRessourcerie_base'] = Web::instance()->slug($ret['nomRessourcerie']);
    $ret['adresseRessourcerie'] = self::cleanInput($data['adresseRessourcerie']);
    if (preg_match('/^[0-9AB]{5}$/', $data['codePostal'])) {
        $ret['codePostal'] =  $data['codePostal'];
    } else {
        $ret['codePostal'] =  preg_match('/[^0-9AB]/', '', $data['codePostal']);
    }
    $ret['ville'] = self::cleanInput($data['ville']);
    $ret['emailRessourcerie'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $ret['motDePasse'] = $data['motDePasse'];
    if($data['motDePasse'] != $data['motDePasseRepetition']) {
        throw new Exception("Les 2 mots de passe ne sont pas identique.");
    }
    if (!empty($_FILES['backupInput']['name'])) {
        $fileName = $_FILES['backupInput']['name'];
        $fileTmp = $_FILES['backupInput']['tmp_name'];
        $uploadDir = rtrim($f3->get('UPLOADS'), '/') . '/';
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($extension, ['sql', 'zip'])) {
            throw new \Exception("Le fichier doit être un fichier SQL ou une archive ZIP contenant un fichier SQL", 1);
        }
        $destPath = $uploadDir . $fileName;
        if (!move_uploaded_file($fileTmp, $destPath)) {
            throw new \Exception("Échec lors du déplacement du fichier uploadé", 1);
        }
        $ret['from_backup'] = $fileName;
        if ($extension === 'zip') {
            $zip = new ZipArchive;
            if ($zip->open($destPath) === TRUE) {
                $zip->extractTo($uploadDir);
                $zip->close();
                $sqlFile = glob($uploadDir . "*.sql");
                if (empty($sqlFile)) {
                    throw new \Exception("Aucun fichier SQL trouvé dans l'archive ZIP", 1);
                }
                $ret['backupInput'] = $sqlFile[0];
                if (file_exists($destPath)) {
                  unlink($destPath);
                }
            } else {
                throw new \Exception("Impossible d'ouvrir le fichier ZIP", 1);
            }
        } else {
            $ret['backupInput'] = $destPath;
        }
    }
    return $ret;
  }

  function verifyDatabaseAndFolder($f3, $check = false)
  {
    $db_name = $f3->get('SESSION.db_name');
    $audit = [
        'database_root' => false,
        'database_instance' => false,
        'oresource_path' => false,
        'instance_link' => false,
    ];
    try {
        $dbh = $this->getDBH($f3, $db_name);
    } catch (Exception $e) {
        $dbh = null;
    }
    if ($dbh) {
        $audit['instance_name'] = $db_name;
        $audit['database_instance'] = 1;
        if (!$check) {
            throw new \Exception("Une base de donnée existe déjà pour cette ressourcerie", 1);
        }
    }

    if ($this->instanceIsUnique($f3, $db_name)) {
        $audit['instance_link'] = 1;
    } else {
        if (!$check) {
            throw new \Exception("Une instance existe déjà pour cette ressourcerie", 1);
        }
    }
    if (! is_dir(Config::getInstance()->getORessourcePath())) {
        $audit['oresource_path'] = 1;
        if (!$check) {
            throw new \Exception("Le dossier ORessource est introuvable", 1);
        }
    }
    return $audit;
  }

  function instanceIsUnique($f3, $db_name)
  {
    return ! is_dir('./'. $db_name);
  }

  function visualisation(Base $f3)
  {
    $f3->set('content', 'visualisation.html.php');
    if (!file_exists(Config::getInstance()->getORessourcePath().'/'.$f3->get('SESSION.instance_name'))) {
        return $f3->reroute('/validation');
    }
    $db_name = $f3->get('SESSION.db_name');
    $exists = $this->dbExists($f3, $db_name);
    if (!$exists) {
        return $f3->reroute('/validation');
    }
    echo View::instance()->render('/layout.html.php');
  }

  function generate(Base $f3)
  {
    $data['host'] = '$host = "'.addslashes(Config::getInstance()->getDBHost()).'";';
    $data['port'] = '$port = "'.addslashes(Config::getInstance()->getDBPort()).'";';
    $data['base'] = '$base = "' . addslashes($f3->get('SESSION.db_name')).'";';
    $data['user'] = '$user = "' . addslashes($f3->get('SESSION.db_name')).'";';
    $pass = md5(uniqid(date('dmY').$f3->get('SESSION.db_name').rand(0, 10000)));
    $data['pass'] = '$pass = "'. addslashes($pass).'";';
    try {
      clearstatcache(true);
      if (file_exists('./'.$f3->get('SESSION.instance_name'))) {
          throw new \Exception("L'instance existe déjà", 1);
      }
      if (! symlink(Config::getInstance()->getORessourcePath(), './'.$f3->get('SESSION.instance_name'))) {
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

  public function checkConfig($f3, $data)
  {
      $audits = $this->verifyDatabaseAndFolder($f3, true);
      if ($this->getDBH($f3)) {
          $audits['database_root'] = 1;
      }
      print_r([$audits]);exit;
  }

  function createConfig($f3, $data)
  {
    $config_path = Config::getInstance()->getORessourcePath().'/config';
    if (! is_dir($config_path)) {
        mkdir($config_path);
    }
    $config_path .= '/config_' . $f3->get('SESSION.instance_name') . '.php';

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
    if (!$sql->execute()) {
        $errors = $sql->errorInfo();
        error_log("Erreur lors de la création de la base $db_name: ".$errors[2]);
        throw new \Exception("Erreur lors de la création de la base");
    }

    $sql = $dbh->prepare("CREATE USER :user@localhost IDENTIFIED BY :pass;");
    if (!$sql->execute(array(':user' => $user, ':pass' => $pass))) {
        $errors = $sql->errorInfo();
        error_log("Erreur lors de la création de l'utilisateur $user: ".$errors[2]);
        throw new \Exception("Erreur lors de la création de l'utilisateur");
    }

    $sql = $dbh->prepare("GRANT SELECT, INSERT, UPDATE, DELETE, LOCK TABLES ON `$db_name`.* TO :user@'localhost' IDENTIFIED BY :pass;");
    if (!$sql->execute(array(':user' => $user, ':pass' => $pass))) {
        $errors = $sql->errorInfo();
        error_log("Erreur lors de l'attribution des droits $user: ".$errors[2]);
        throw new \Exception("Erreur lors de l'attribution des droits");
    }

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
    $dbh = $this->getDBH($f3, $db_name);

    $dbh->beginTransaction();
    $search = ['NOM_RESSOURCERIE', 'ADRESSE_RESSOURCERIE', 'MAIL_RESSOURCERIE', 'VILLE_RESSOURCERIE', 'DATE_CREATION'];
    $replace = [addslashes($f3->get('SESSION.nomRessourcerie')), addslashes($f3->get('SESSION.adresseRessourcerie')),
                addslashes($f3->get('SESSION.emailRessourcerie')), addslashes($f3->get('SESSION.ville')), date('Y-m-d H:i:s')];
    if (! $dbh->query(str_replace($search, $replace, file_get_contents($backup)))) {
        $errors = $dbh->errorInfo();
        error_log("Erreur query backup pour $db_name: ".$errors[2]);
        return false;
    }

    $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`timestamp`, `niveau`, `nom`, `prenom`, `mail`, `pass`, `id_createur`, `id_last_hero`, `last_hero_timestamp`) ".
                         "VALUES (:timestamp, :niveau, :nom, :prenom, :mail, :pass, :id_createur, :id_last_hero, :last_hero_timestamp);");
    $ret = $sth->execute(['timestamp' => date('Y-m-d H:i:s'), 'niveau' => 'c1c2c3v1v2v3s1s2s3bighljk', 'nom' => 'administrateur.ice',
                         'prenom' => 'oressource', 'mail' => $f3->get('SESSION.emailRessourcerie'), 'pass' => md5($f3->get('SESSION.motDePasse')),
                         'id_createur' => 1, 'id_last_hero' => 1, 'last_hero_timestamp' =>  date('Y-m-d H:i:s')]);

    if (! $ret) {
        $errors = $sth->errorInfo();
        error_log("Erreur query user pour $db_name: ".$errors[2]);
        return false;
    }

    return true;
  }

  function validation(Base $f3)
  {
    $f3->set('content', 'validation.html.php');
    echo View::instance()->render('/layout.html.php');
  }
}

<?php

use app\config\Config;

class CtrlORessourceGenerator
{
  function index(Base $f3)
  {
    echo View::instance()->render('/home.html.php');
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
      $pass = md5(uniqid(date('dmY').$db_name.rand(0, 10000)));
      $user=$db_name;
      mkdir($f3->get('ROOT').'/instances/'.$db_name);
    } else {
      throw new \Exception("Une instance existe déjà pour cette ressourcerie", 1);
    }

    try {
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
  }

  function instanceIsUnique($f3, $db_name)
  {
    return ! is_dir($f3->get('ROOT') .'/instances/'. $db_name);
  }

  function visualisation(Base $f3)
  {
    echo View::instance()->render('/visualisation.html.php');
  }

  function redirectToInstance(Base $f3)
  {
    return $f3->reroute('/'.$f3->get('SESSION.departement').'_'.$f3->get('SESSION.nomRessourcerie_base'));
  }
}

<?php

namespace app\config;

class Config
{
  private static $_instance = null;
  protected $config = null;
  protected $f3 = null;

  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new Config();
    }
    return self::$_instance;
  }

  public function __construct() {
    $config = null;
    $this->f3 = \Base::instance();

    if(file_exists(__DIR__.'/../../config/config.php')) {
      include(__DIR__.'/../../config/config.php');
    }

    if (!$config) {
      $this->config = [];
    }else{
      $this->config = $config;
    }
  }

  public function getConfig()
  {
    return $this->config;
  }

  public function get($key, $default = null)
  {
    return array_key_exists($key, $this->config) ? $this->config[$key] : $default;
  }

  public function exists($v)
  {
    return isset($this->config[$v]);
  }

  public function set($k, $v)
  {
    if (! $this->isEditable) {
      throw new \LogicException("Il n'est pas possible d'éditer la configuration hors test");
    }

    $this->config[$k] = $v;
  }

  public function getUrlbase()
  {
    if (!isset($this->config['urlbase'])) {
      $port = $this->f3->get('PORT');
      $this->config['urlbase'] = $this->f3->get('SCHEME').'://'.$_SERVER['SERVER_NAME'].(!in_array($port,[80,443])?(':'.$port):'').$this->f3->get('BASE');
    }
    return $this->config['urlbase'];
  }
}

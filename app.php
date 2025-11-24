<?php

use app\config\Config;

$f3 = require(__DIR__.'/vendor/fatfree-core/base.php');

require __DIR__.'/vendor/autoload.php';
$f3->set('DEBUG', 3);
$f3->set('ROOT', __DIR__);
$f3->set('UI', $f3->get('ROOT')."/app/views/");
$f3->set('PARTIALS', "../app/views/partials");
$f3->set('UPLOADS', '/tmp/oressource');

$f3->set('urlbase', Config::getInstance()->getUrlbase());

include('app/routes.php');

return $f3;

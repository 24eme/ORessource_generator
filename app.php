<?php

use app\config\Config;

$f3 = require(__DIR__.'/vendor/fatfree-core/base.php');

require __DIR__.'/vendor/autoload.php';
$f3->set('DEBUG', 3);
$f3->set('ROOT', __DIR__);
$f3->set('UI', $f3->get('ROOT')."/app/views/");
$f3->set('MAIL', 'contact@24eme.fr');
$f3->set('UPLOADS', $f3->get('ROOT').'/data/uploads/');

$f3->set('urlbase', Config::getInstance()->getUrlbase());

$f3->set('PATH_ORESSOURCE', "../../oressource");



include('app/routes.php');

return $f3;

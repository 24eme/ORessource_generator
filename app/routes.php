<?php
require_once('controllers/CtrlORessourceGenerator.class.php');

$f3->route('GET /', 'CtrlORessourceGenerator->index');
$f3->route('GET /index', 'CtrlORessourceGenerator->index');
$f3->route('GET /demarrer', 'CtrlORessourceGenerator->demarrer');
$f3->route('GET /selfhost', 'CtrlORessourceGenerator->selfhost');
$f3->route('GET /webhost', 'CtrlORessourceGenerator->webhost');
$f3->route('GET /create', 'CtrlORessourceGenerator->create');
$f3->route('GET /visualisation', 'CtrlORessourceGenerator->visualisation');
$f3->route('GET /redirect', 'CtrlORessourceGenerator->redirectToInstance');
$f3->route('GET /validation', 'CtrlORessourceGenerator->validation');
$f3->route('GET /assistance', 'CtrlORessourceGenerator->assistance');
$f3->route('GET /apropos', 'CtrlORessourceGenerator->apropos');
$f3->route('POST /dataCheck', 'CtrlORessourceGenerator->dataCheck');
$f3->route('POST /generate', 'CtrlORessourceGenerator->generate');
$f3->route('GET /check', 'CtrlORessourceGenerator->checkConfig');

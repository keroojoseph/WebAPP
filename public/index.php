<?php

use App\Libs\FrontController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
$template_partes = require_once APP_PATH  . "Config" . DS . "templateconfig.php";

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = APP_DEFAULT_LANGUAGE;
}

$template = new \App\Libs\Template($template_partes);
$language = new \App\Libs\Language();
$front = new FrontController($template, $language);
$front->dispatch();

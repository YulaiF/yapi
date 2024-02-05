<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

global $ROOT_PATH;
$ROOT_PATH = __DIR__;

// Путь к файлу конфигурации
$configFile = 'config.ini';

// Чтение файла конфигурации
global $CONFIG;
global $DEBUG;
$CONFIG = parse_ini_file($configFile, true);

// Проверка на успешное чтение
//if ($config === false) {
//    die('Unable to read the config file.');
//}
$DEBUG = $CONFIG['settings']['debug'] == true || $_GET['debug'] == true;

// Разбираем url
$url = (isset($_GET['yapirequest'])) ? $_GET['yapirequest'] : '';
$url = rtrim($url, '/');


// Подключаем файл-роутер и запускаем главную функцию
$routerFilePath = 'routers/router.php';
include_once $routerFilePath;
YAPI\Router\route($url);
die();

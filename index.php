<?php
session_start(); 
$_SESSION["id"] = 0;

require (__DIR__ ."/includes/classloader.php");

$source = $_SERVER['DOCUMENT_ROOT'];
$dir = $source.'/elements/';

require($dir."elmentfunctions.php");

$database = new Dbconfig();
$db = $database->getConnection();
$sqlQuery = new Sql($db); 
$databases;

$request = $_SERVER['REQUEST_URI'];
//var_dump($request);
$url = parse_url($request);

$urlpaths = explode("/", $url["path"]);
switch($urlpaths[1]) {
    case '/':
    case '':
    case 'index':
    case 'home':
        require __DIR__ . '/webpage/index.php';
        break;
    case 'profile':
        require __DIR__ . '/webpage/profile.php';
        break;
    case 'login':
        require __DIR__ . '/webpage/login.php';
        break;
    case 'search':
        require __DIR__ . '/webpage/search.php';
        break;
    case 'register':
        require __DIR__ . '/webpage/register.php';
        break;
    case 'test':
        require __DIR__ . '/webpage/create_profile.php';
        break;
    default:
        require __DIR__ . '/webpage/404.php';
        header("HTTP/1.1 404 Not Found");
        break;
}
?>
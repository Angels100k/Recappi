<?php
session_start(); 
include_once (__DIR__ ."/includes/classloader.php");

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
    case 'profiel':
        require __DIR__ . '/webpage/profiel.php';
        break;
    default:
        require __DIR__ . '/webpage/404.php';
        header("HTTP/1.1 404 Not Found");
        break;
}
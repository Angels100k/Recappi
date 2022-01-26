<?php
session_start(); 
require (__DIR__ ."/includes/classloader.php");

(new EnvReader(__DIR__ . '/.env'))->load();

$source = $_SERVER['DOCUMENT_ROOT'];
$dir = $source.'/elements/';
require($dir . "elementfunctions.php");

$database = new Dbconfig(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db); 
$databases;

$dir = __DIR__;
$userid = $_SESSION["id"] ?? 0;

$request = $_SERVER['REQUEST_URI'];
$url = parse_url($request);

$urlpaths = explode("/", $url["path"]);
if($userid != 0){
    switch($urlpaths[1]) {
        case '/':
        case '':
        case 'index':
        case 'home':
            require __DIR__ . '/webpage/main.php';
            break;
        case 'recipes':
            require __DIR__ . '/webpage/myrecipe.php';
            break;
        case 'profile':
            require __DIR__ . '/webpage/profile.php';
            break;
        case 'recipe':
            require __DIR__ . '/webpage/recipe.php';
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
        case 'edit':
            require __DIR__ . '/webpage/edit.php';
            break;
        case 'settings':
            require __DIR__ . '/webpage/settings.php';
            break;
        case 'create':
            require __DIR__ . '/webpage/edit.php';
            break;
        case 'logout':
            require __DIR__ . '/webpage/logout.php';
            break;
        case 'search':
            require __DIR__ . '/webpage/search.php';
            break;
        case 'shoppinglist':
        case 'boodschappenlijst':
            require __DIR__ . '/webpage/shoplist.php';
            break;
        default:
            $admin = $_SESSION["admin"] ?? 0;
            if($admin === 1 && $urlpaths[1] == "admin"){
                require __DIR__ . '/webpage/adminmain.php';
            }else {
                require __DIR__ . '/webpage/404.php';
                break;
            }
    }
}else {
    switch($urlpaths[1]) {
        case '/':
        case '':
        case 'index':
            require __DIR__ . '/webpage/index.php';
            break;
        case 'login':
            require __DIR__ . '/webpage/login.php';
            break;
        case 'register':
            require __DIR__ . '/webpage/register.php';
            break;
        default:
            require __DIR__ . '/webpage/index.php';
            break;
    }

}
?>
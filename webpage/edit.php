<?php
$url = $urlpaths[2] ?? "";
switch($url) {
    case 'profile':
        require $dir . '/webpage/edit/profile.php';
        break;
    case 'recept':
        require $dir . '/webpage/edit/recept.php';
        break;
    default:
        require $dir . '/webpage/404.php';
        header("HTTP/1.1 404 Not Found");
        break;
    }
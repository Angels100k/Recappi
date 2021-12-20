<?php
$url = $urlpaths[2] ?? "";
switch($url) {
    case 'profile':
        require $dir . '/webpage/edit/profile.php';
        break;
    case 'recipe':
    case 'recept':
        require $dir . '/webpage/edit/recipe.php';
        break;
    default:
        require $dir . '/webpage/404.php';
        header("HTTP/1.1 404 Not Found");
        break;
    }
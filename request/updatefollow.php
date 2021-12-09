<?php
session_start();

$json = json_decode(file_get_contents('php://input'), true);
require ($_SERVER['DOCUMENT_ROOT']."/includes/classloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();
$item;
$source = $_SERVER['DOCUMENT_ROOT'];
$dir = $source.'/elements/';
require($dir . "elementfunctions.php");

$database = new Dbconfig(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db);

$hoi=$sqlQuery->updatefollow($json["followid"]);
while ($row = $hoi->fetch()):
    $item = $row;
endwhile;
echo json_encode($item);
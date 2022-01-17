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

$currentstep = 0;

$sqlQuery->addToShoppingList($json);

// $array = [[]];

// $ingredients = $sqlQuery->ingredientMethodRecipe($json["recipeId"]); 
// while($row = $ingredients->fetch()):
//     array_push($array[0], dd_preprecipe($row));
//     $currentstep = $row["step"];
// endwhile;
// array_push($array, $currentstep);

// echo json_encode($array);
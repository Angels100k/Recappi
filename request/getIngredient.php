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

$array = [];

$ingredientlistRecipe = $sqlQuery->currentIngredientlistRecipe($json["recipeId"]);

while ($row = $ingredientlistRecipe->fetch()) :
    array_push($array, '<button onclick="addIngredientStep(`'.$row["ingredient"].'`, this)" class="bg-white button mt-05-not-first r-max  border-primary">'.$row["ingredient"].'</button>');
endwhile;

echo json_encode($array);
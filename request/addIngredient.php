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


$sqlQuery->addIngredient($json);

$array = [[],[]];

$ingredientlistRecipe = $sqlQuery->ingredientlistRecipe($json["recipeId"]);

while ($row = $ingredientlistRecipe->fetch()) :
    array_push($array[0], dd_showingradientlistedit($row));
endwhile;


$ingredientType = $sqlQuery->ingredientTypes();

while ($row = $ingredientType->fetch()) : 
    // var_dump($row);
    array_push($array[1], '<option data-value="'.$row["id"].'">'.$row["ingredient"].'</option>');
endwhile;

echo json_encode($array);
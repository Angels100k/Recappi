<?php
$source = $_SERVER['DOCUMENT_ROOT'];
$dir = $source.'/classes/';
$ext = ".php";
$file = 'people.txt';
$items = [];
foreach(scandir($dir) as $item){
    if (!($item == '.')) {
        if (!($item == '..')) {
            if(in_array($item, $items)){} else {
                array_push($items, $item);
            }
        }
    }
}
foreach($items as $item){
    require ($dir.$item);
}
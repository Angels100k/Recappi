<?php

// Image

header('Content-type: application/json');
$file = 'people.txt';

$json = json_decode(file_get_contents('php://input'), true);
$dir = 'assets/img/';
$name = $json["img"] ?? "";
$type = $json["type"]?? "";
// Open the file to get existing content
// Write the contents back to the file
create_img($name, $type);
echo json_encode(($dir. $name . "." . $type));
function create_img($name, $type){
    $dir = 'assets/img/';
    $newName = $name.'.webp';
    $name .= "." . $type;
    // Create and save
    if(mime_content_type($dir. $name) == "image/jpeg"){
        $img = imagecreatefromjpeg($dir . $name);
        
    }elseif (mime_content_type($dir. $name) == "image/png") {
        $img = imagecreatefrompng($dir . $name);
    }else {
        $img = "";
    }
    if($img != ""){
        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);
        imagewebp($img, $dir . "webp/" . $newName, 100);
        imagedestroy($img);
    }
}


?>
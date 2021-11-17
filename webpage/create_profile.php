<?php

// Image
$dir = 'assets/img/';
$name = "testing.png";
$newName = 'testing.webp';
echo mime_content_type($dir. $name);
// Create and save
if(mime_content_type($dir. $name) == "image/jpeg"){
    $img = imagecreatefromjpeg($dir . $name);
    
}elseif (mime_content_type($dir. $name) == "image/png") {
    $img = imagecreatefrompng($dir . $name);
}
imagepalettetotruecolor($img);
imagealphablending($img, true);
imagesavealpha($img, true);
imagewebp($img, $dir . "webp/" . $newName, 100);
imagedestroy($img);

// ?>
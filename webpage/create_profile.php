<?php

// Image
$dir = 'assets/img/';
$name = "Logo2.png";
$newName = 'Logo2.webp';
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
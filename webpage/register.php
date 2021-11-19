<?php 
$style = '<link rel="stylesheet" href="./assets/css/main.css">';
$style .= '<link rel="stylesheet" href="./assets/css/login.css">';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?=dd_head("Register", $style)?>
    
</head>
<body  style="background-color:<?=getenv("COLOR_PRIMARY")?>">

<div class="bg-white home-top" style="margin-bottom: 53.5px;">
        <div class="d-flex jc-center home-image">
            <?=dd_img("logo-white", "png", "", "padding:1rem;background-color:". getenv("COLOR_PRIMARY") .";border-radius: 1.5rem;")?>
        </div>
    </div>

</body>
</html>
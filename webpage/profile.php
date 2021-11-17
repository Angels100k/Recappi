<?php

$x=0;
$y=0;
$url = $urlpaths[2] ?? "";
$email = "";
$image = "";
if($url != ""){
    $x = 1;
        $stmt = $sqlQuery->getprofile($url);
    while($row = $stmt->fetch()){
        $email = $row['email'];
        $image = $row['image'];
        $y++;
    }
}else {
    $x = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if($y === 1){?>
        <img src="<?= "/assets/img/" .$image;?>" width="300" height="300" style="">
        <h1>Hallloooo <?=$email;?> </h1> 

        <?php }else {?>
            <h1>profile not found</h1>
        <?php }?>
    
</body>
</html>
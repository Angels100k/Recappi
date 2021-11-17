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
        $type = $row['imgtype'];
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
    <title>Recappi | Profile of <?=$url?></title>
    <meta name="twitter:label1" content="Person">
    <meta name="twitter:data1" content="<?=$url?>">
    
    <meta name="twitter:label2" content="Amount posts">
    <meta name="twitter:data2" content="943">
</head>
<body>
    <?php 
        if($y === 1){
            echo dd_img($image, $type, '300px', 'object-fit:cover;');
            ?>
        <h1>Hallloooo <?=$email;?> </h1> 

        <?php }else {?>
            <h1>profile not found</h1>
        <?php }?>
    
</body>
</html>
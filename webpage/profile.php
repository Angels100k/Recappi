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
$extra = '<meta name="twitter:label1" content="Person"><meta name="twitter:data1" content="'.$url.'"><meta name="twitter:label2" content="Amount posts"><meta name="twitter:data2" content="943">';
$title = "Recappi | Profile of ".$url;
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
<?=dd_head($title, $extra)?>
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
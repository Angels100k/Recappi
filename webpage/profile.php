<?php

$x=0;
$y=0;
$url = $urlpaths[2] ?? "";
$email = "";
$image = "";
$name = "";
if($url != ""){
    $x = 1;
        $stmt = $sqlQuery->getprofile($url);
    while($row = $stmt->fetch()){
        $email = $row['email'];
        $image = $row['image'];
        $name = $row['name'];
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

<body style="background-color: var(--background)">

    <?php 
        if($y === 1):?>
        <div class="profile-main row">
            <div class="col-5"><?=dd_img($image, $type, '98px', '98px', '', "profile-main-picture")?></div>
            <div class="col-7">
            <div class="row text-center">
                    <div class="col-1-3">
                        <div>
                            <h1 class="mt-0 pl-1"><?=$name?></h1>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-1-3">
                        <div class="text-bold">100</div>
                        <div>recepten</div>
                    </div>
                    <div class="col-1-3">
                        <div class="text-bold">30</div>
                        <div>volgers</div>
                    </div>
                    <div class="col-1-3">
                        <div class="text-bold">40</div>
                        <div>volgend</div>
                    </div>
                </div>
            </div>
        </div>
            
            
        <h1>Hallloooo <?=$email;?> </h1> 

        <?php else: ?>
            <h1>profile not found</h1>
        <?php endif;?>
    
</body>
</html>
<?php

$x=0;
$y=0;
$url = $urlpaths[2] ?? "";
$cat = $urlpaths[3] ?? "";
$email = "";
$cookbook = array(array("breakfast", 0),array("lunch", 3));
$image = "";
$name = "";
$bio = "";
$recepts = "";
$following = "";
$followers = "";
if($url != ""){
    $x = 1;        
        $stmt = $sqlQuery->getprofile($url);

        while($row = $stmt->fetch()){
            $email = $row['email'];
            $name = $row['name'];
            $bio = $row['bio'];
            $recepts = $row['recepts'];
            $following = $row['following'];
            $followers = $row['followers'];
            $type = $row['imgtype'];
            $image = $row['image'];
            $y++;
        }
    if($cat != ""){
        $x = 2;
    }
}else {
    $x = 0;
}
$extra = '<meta name="twitter:label1" content="Person"><meta name="twitter:data1" content="'.$url.'"><meta name="twitter:label2" content="Amount recepts"><meta name="twitter:data2" content="'.$recepts.'">';
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
        <div class="profile-main main-container shadow row">
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
                        <div class="text-bold"><?=$recepts?></div>
                        <div>recepten</div>
                    </div>
                    <div class="col-1-3">
                        <div class="text-bold"><?=$following?></div>
                        <div>volgers</div>
                    </div>
                    <div class="col-1-3">
                        <div class="text-bold"><?=$followers?></div>
                        <div>volgend</div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="text-center col-1-3">
                        <div class="text-bold">Biografie</div>
                    </div>
                    <div class="col-12 mt-1">
                        <div><?=$bio?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($x === 1):?>
            <div class="main-container mt-3">
            <div class="row">
                    <h2 class="text-bold">Cookbook</h2>
            </div>
            <div class="row">
                <?php
                    foreach ($cookbook as &$value) {
                        ?>
                        <a href="/profile/<?=$url?>/<?=$value[0]?>" class="txt-black shadow col-12 bg-white p-1 border-small bs-bb mt-05">
                            <div>
                                <span class="text-bold"><?=$value[0]?></span>
                                <div><?=$value[1]?> recipes</div>
                            </div>
                        </a>
                        <?php
                    }
                    // while($row = $cookbook->fetch()):
                        
                    // endwhile;
                ?>
                <!-- items -->
             </div>
        </div>
        <?php elseif($x === 2):
            $stmt = $sqlQuery->getcookbookcat($cat, $url);
            ?>
                        <div class="row main-container"><?php
        while($row = $stmt->fetch()){
            ?>
                        <a href="/profile/<?=$url?>/<?=$cat?>/" class="txt-black shadow col-12 bg-white p-1 border-small bs-bb mt-05">
                        <div class="row">
                            <div class="col-12"><h2 class="text-bold"><?=$row["receptname"]?></h2></div>
                            <div class="col-7">hi</div>
                            <div class="col-5 jc-center">
                            <?=dd_img("193747", "jpg", '120px', '120px', '', "border-small")?>
                            </div>
                        </div>
                                
                        </a>
                        <?php
        }
        ?></div>
    <?php endif;?>
    <?php else: ?>
        
        <h1>profile not found</h1>
    <?php endif;?>
    
</body>
</html>
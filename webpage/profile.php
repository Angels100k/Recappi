<?php

$x=0;
$y=0;
$url = $urlpaths[2] ?? "";
$cat = $urlpaths[3] ?? "";
$email = "";
$cookbook = "";
$image = "";
$name = "";
$bio = "";
$id = "";
$recepts = "";
$following = "";
$followers = "";
if($url != ""){
    $x = 1;        
        $stmt = $sqlQuery->getprofile($url);
        $cookbook = $sqlQuery->getcookbookamount($url);

        while($row = $stmt->fetch()){
            $email = $row['email'];
            $name = $row['name'];
            $id = $row['id'];
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
$extra = '  <meta name="twitter:label1" content="Person">
            <meta name="twitter:data1" content="'.$url.'">
            <meta name="twitter:label2" content="Amount recepts">
            <meta name="twitter:data2" content="'.$recepts.'">';
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
            <?php 
                if($id == $_SESSION["id"]){
                ?>
                <div class="row">
                    <h2 class="text-bold"><?=dd_img("list-ul", "svg", '18px', '18px')?> <span class="ml-05">My shopping list</span></h2>
                </div>
                <div class="row">
                <h2 class="text-bold"><?=dd_img("pen-black", "svg", '18px', '18px')?> <span class="ml-05">Drafts</span></h2>
                </div>
                <div class="row">
                <?php $draftrecepts = $sqlQuery->getcookbookdraftbig(); ?>
            <div class="row main-container flex-wrap-no w-100 overflow-x-auto mr--1">
                <?php
                    while($row = $draftrecepts->fetch()):
                        echo draftrecipebig($row);
                    endwhile;
                ?>
            </div>
             </div>
            <?php }?>
            <div class="row">
                    <h2 class="text-bold"><?=dd_img("bars", "svg", '18px', '18px')?> <span class="ml-05">Cookbook</span></h2>
            </div>
            <div class="row">
                <?php while($row = $cookbook->fetch()): ?>
                    <a href="/profile/<?=$url?>/<?=$row[0]?>" class="txt-black shadow col-12 bg-white p-1 border-small bs-bb mt-05">
                        <div>
                            <span class="text-bold"><?=$row[0]?></span>
                            <div><?=$row[1]?> recipes</div>
                        </div>
                    </a>
                <?php endwhile;?>
             </div>
        </div>
        <?php elseif($x === 2):
            $stmt = $sqlQuery->getcookbookcat($cat, $url);
            ?>
            <div class="row main-container mt-3">
                <h2><?=$cat?></h2>
                <?php
                while($row = $stmt->fetch()):
                        echo dd_layout_post($row['id'], $row["recipe"], $row["preptime"],$row["difficulty"], $row["likes"], $row["repsonses"], $row["image"], $row["type"], $row["likeid"], $row["saveid"], $row["userid"]);
                endwhile;
                ?>
            </div>
        <?php endif;?>
        <?php else: ?>
            <h1>profile not found</h1>
        <?php endif;?>
    
</body>
</html>
<?php 
// var_dump($urlpaths[2]);
$recipeid = $urlpaths[2];
$recipedefault = $sqlQuery->getrecipedefault($recipeid);
$title = "Recipe";
$info = "";
while($row = $recipedefault->fetch()){
    $info = $row;
}
$extra = '<meta name="description" content="'.$info["description"].'">';
$extra .= '<meta name="twitter:description" content="'.$info["description"].'">';
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
<?=dd_head($title, $extra)?>
</head>

<body style="background-color: var(--background)">
<?php require $dir.'/elements/navbar/navbar.php';?>
<div class=" profile-main row shadow">
    <div class="mr-2">
        <?=dd_img($info["image"], $info["imgtype"], '32px', '32px', '', "profile-main-picture", "", "profileimage", ' data-name="'. $info["image"] .'" data-type="'. $info["imgtype"] .'"')?>
    </div>
    <div>
        <span class="text-bold"><?= $info["name"] ?></span><br>
        <div class=" text-overflow">
        <span class="text-nowrap"><?= $info["description"] ?></span>
        </div>
    </div>

    <div class="row flex-wrap-no w-100 overflow-x-auto mr--1 mt-3 snap-x">   
        <?php 
        $images = $sqlQuery->receppiimages($recipeid);
        while($row = $images->fetch()){
                echo dd_img($row["image"], $row["type"], '195px', '195px', '', "border-small object-cover mr-2 snap-center", "", "", ' data-name="'. $row["image"] .'" data-type="'. $row["type"] .'"');
        }
        ?>
    </div>
    <div class="row w-100">
        <div class="col text-center">
        <h1 class="text-bold">
            <?=$info["recipe"]?>
        </h1>
        </div>
    </div>
    <div class="row w-100 mt-1">
        <div class="col text-end mr-2"><?=$info["likes"]?></div>
        <div class="col text"><?=$info["repsonses"]?></div>
    </div>
</div>



<div class=" profile-main row shadow mt-5">
        <div class="col-12 text-center text-bold">
            <?=dd_img("clock", "svg", '32px', '32px');?>
            <span>Time</span>
        </div>
        <div class="col text-center"><span class="text-bold"> <?=  $info["preptime"] ?> min</span> Prep</div>
        <div class="col text-center"><span class="text-bold"> <?=  $info["cooktime"] ?> min</span> cook</div>
    </div>

    <div class="mt-5 mb-4">
        <?php 
        $comments = $sqlQuery->receppicomments($recipeid);
        while($row = $comments->fetch()){
                ?>
            <div class="profile-main p-1 mt-1 row">
                <div class="mr-2">
                    <?=dd_img($row["image"], $row["imgtype"], '32px', '32px', '', "profile-main-picture", "", "profileimage", ' data-name="'. $row["image"] .'" data-type="'. $row["imgtype"] .'"')?>
                </div>
                <div>
                    <span class="text-bold mr-2"><?= $row["username"] ?></span>
                </div>
                <div>  <?= $row["comment"] ?> </div>
            </div>
        
<?php } ?>
    </div>
</body>
</html>
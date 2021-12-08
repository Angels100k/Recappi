<?php
$url = $urlpaths[2] ?? "";
$email = "";
$cookbook = "";
$profileImage = "";
$profileImagetype = "";
$profilename = "";
$username = "";
$bio = "";
$id = "";
$recepts = "";
$following = "";
$followers = "";     
$stmt = $sqlQuery->getprofile($url);
$cookbook = $sqlQuery->getcookbookamountprofile($_SESSION["id"]);

while($row = $stmt->fetch()){
    $email = $row['email'];
    $profilename = $row['name'];
    $username = $row['username'];
    $id = $row['id'];
    $bio = $row['bio'];
    $recepts = $row['recepts'];
    $following = $row['following'];
    $followers = $row['followers'];
    $profileImagetype = $row['imgtype'];
    $profileImage = $row['image'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("homepage")?>
</head>

<body style="background-color: var(--background)">
<?php require $dir.'/elements/navbar.php';?>
    <div class="main-body">
        <div class="main-container mt-5 row">
           <div class="col-12">
           what do you feel like eating

            </div>
            <div class="mt-2 col-12">
                <h2> Recently saved </h2>
                <div class="row flex-wrap-no w-100 overflow-x-auto mr--1">
                <?php $draftrecepts = $sqlQuery->getcookbookresentbig();
                    while($row = $draftrecepts->fetch()):
                for ($x = 0; $x <= 10; $x++) {
                    echo dd_DraftRecipeBigShow($row);
                }
            endwhile;
                ?>
            </div>
            <div class="mt-2 mb-4 col-12">
                    <div class="row">
                        <h2 class="text-bold"><?=dd_img("bars", "svg", '18px', '18px')?> <span class="ml-05">Cookbook</span></h2>
                    </div>
                    <div class="row">
                        <?php while($row = $cookbook->fetch()):
                for ($x = 0; $x <= 10; $x++) {
                    ?>
                            <a href="/profile/<?=$row["username"]?>/<?=$row["name"]?>" class="txt-black shadow col-12 bg-white p-1 border-small bs-bb mt-05">
                                <div>
                                    <span class="text-bold"><?=$row["name"]?></span>
                                    <div><?=$row["amountrecepts"]?> recipes</div>
                                </div>
                            </a>
                        <?php } endwhile;?>
                    </div>
            </div>
           </div>
        </div>
    </div>
    <?php require $dir.'/elements/main-footer.php';?>
</body>

</html>
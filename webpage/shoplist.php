<?php
$x = 0;
$y = 0;
$url = $urlpaths[2] ?? "";
$cat = $urlpaths[3] ?? "";
$email = "";
$profileImage = "";
$profileImagetype = "";
$followimg = "";
$name = "";
$username = "";
$bio = "";
$id = "";
$recepts = "";
$following = "";
$followingperson = "";
$followers = "";
if ($url != "") {
    $x = 1;
    $stmt = $sqlQuery->getprofile($url);

    while ($row = $stmt->fetch()) {
        $email = $row['email'];
        $name = $row['name'];
        $username = $row['username'];
        $id = $row['id'];
        $followingperson =  $row['personfollow'];
        $bio = $row['bio'];
        $recepts = $row['recepts'];
        $following = $row['following'];
        $followers = $row['followers'];
        $profileImagetype = $row['imgtype'];
        $profileImage = $row['image'];
        $y++;
    }
    if ($cat != "") {
        $x = 2;
    }
} else {
    $x = 0;
}
$extra = '  <meta name="twitter:label1" content="Person">
            <meta name="twitter:data1" content="' . $url . '">
            <meta name="twitter:label2" content="Amount recepts">
            <meta name="twitter:data2" content="' . $recepts . '">';
$title = "Recappi | Profile of " . $url;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= dd_head($title, $extra) ?>
</head>

<body style="background-color: var(--background)">
    <?php require $dir . '/elements/navbar/navbar.php'; ?>

    <div class="main-container mt-5">
        <div class="row">
            <h2 class="text-bold"><?= dd_img("list-ul", "svg", '18px', '18px') ?> <span class="ml-05">My shopping list</span></h2>
        </div>
        <div class="row shadow bg-white p-1 border-small bs-bb mt-05" id="shoppingListContainer">
            <?php
                $countShopList = 0;
                $draftrecepts = $sqlQuery->ingredientlist();
            while ($row = $draftrecepts->fetch()) :
                echo dd_showshoppinglistedit($row);
                $countShopList++;
            endwhile;
            if($countShopList === 0){
                echo "No current items in shopping list";
            }
            ?>
        </div>

    <div class="main-container d-grid">
        <p class="text-bold">Add amount</p>
        <input type="number" id="ingredientAmount" placeholder="Add amount">
    </div>

    <div class="main-container d-grid">
        <p class="text-bold">Add ingredient</p>
        <input type="text" placeholder="Add ingredient" id="ingredientDesc" list="ingredients">
        <datalist id="ingredients">
            <?php
                $draftrecepts = $sqlQuery->ingredientTypes();
                while ($row = $draftrecepts->fetch()) : 
                    echo '<option data-value="'.$row["id"].'">'.$row["ingredient"].'</option>';
                endwhile;
            ?>
        </datalist>
    </div>

    <div class="main-container d-grid">
        <p class="text-bold">Add volume (Optional)</p>
        <input type="number" id="ingredientVolume" placeholder="Add volume">
    </div>
    
    <div class="main-container d-grid">
        <p class="text-bold">Add unit (Optional)</p>
        <input type="text" id="ingredientUntit" placeholder="Add unit">
    </div>
    <div class="main-container d-flex mb-4">
                <a class="mt-2 text-end text-bold txt-primary d-none" data-id="0" id="cancelIngredient">Cancel</a>
                <a class="mt-2 text-end ml-auto text-bold txt-primary" data-id="0" id="addIngredient">Add ingredient</a>
</div>
    </div>
<script src="/assets/js/shoppinglist.js"></script>
</body>
</html>
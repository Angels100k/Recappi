<?php
$x = 0;
$y = 0;
$url = $urlpaths[2] ?? "";
$cat = $urlpaths[3] ?? "";
$email = "";
$cookbook = "";
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
    $cookbook = $sqlQuery->getcookbookamount($url);

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
            $draftrecepts = $sqlQuery->ingredientlist();
            while ($row = $draftrecepts->fetch()) :
                echo dd_showshoppinglistedit($row);
            endwhile;
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
<script>
    var addIngredient = document.getElementById("addIngredient");   
    var cancelIngredient = document.getElementById("cancelIngredient");
    var shoppingListContainer = document.getElementById("shoppingListContainer");
    var ingredientAmount = document.getElementById("ingredientAmount");
    var ingredientVolume = document.getElementById("ingredientVolume");
    var ingredientUntit = document.getElementById("ingredientUntit");
    var ingredientDesc = document.getElementById("ingredientDesc");
    var ingredientsOptions = document.getElementById("ingredients");

    cancelIngredient.onclick = function() {klikajCancel()};

    addIngredient.onclick = function() {
        var data = {
            "ingredientAmount" : ingredientAmount.value,
            "ingredientVolume" : ingredientVolume.value,
            "ingredientUntit"  : ingredientUntit.value,
            "ingredientDesc"  : ingredientDesc.value,
            "id": addIngredient.dataset.id,
            "recipeId" : null
        }
        if(ingredientAmount.value != "" && ingredientDesc.value != ""){
            fetch("/request/addIngredientShoppinglist.php", {
                method: 'POST',
                body: JSON.stringify(data),
            }).then(response => response.json())
            .then(result => {
                console.log(result)
                // var array = JSON.parse(result);

                shoppingListContainer.innerHTML = "";
                result[0].forEach(async function(rating) {
                    shoppingListContainer.innerHTML += rating;
                })
                ingredientsOptions.innerHTML = "";
                result[1].forEach(async function(rating) {
                    ingredientsOptions.innerHTML += rating;
                })

                ingredientAmount.value = "";
                ingredientUntit.value = "";
                ingredientDesc.value = "";
                ingredientVolume.value = "";

                document.getElementById("addIngredient").innerHTML = "Add ingredient";
                document.getElementById("addIngredient").dataset.id = 0;
                document.getElementById("cancelIngredient").classList.add("d-none");
            });
        }
        
    }
    
</script>
</body>
</html>
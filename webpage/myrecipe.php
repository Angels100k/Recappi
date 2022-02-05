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
<?php require $dir.'/elements/navbar/navbar.php';?>
    <div class="main-body">
        <div class="main-container mt-5 row">
           <div class="col-12">
               <input class="txt-subheader" type="text" id="searchbar" placeholder="What do you feel like eating?"/>

            </div>
            <div class="mt-2 col-12">
                <h2> Recently saved </h2>
                <div class="row flex-wrap-no w-100 overflow-x-auto mr--1">
                <?php $draftrecepts = $sqlQuery->getcookbookresentbig();
                    while($row = $draftrecepts->fetch()):
                    echo dd_DraftRecipeBigShow($row);
            endwhile;
                ?>
            </div>
            <div class="mt-2 mb-4 col-12">
                    <div class="row">
                        <h2 class="text-bold"><?=dd_img("bars", "svg", '18px', '18px')?> <span class="ml-05">Cookbook</span></h2>
                    </div>
                    <div class="row">
                        <?php while($row = $cookbook->fetch()): ?>
                            <a href="/profile/<?=$row["username"]?>/<?=$row["name"]?>" class="txt-black shadow col-12 bg-white p-1 border-small bs-bb mt-05">
                                <div>
                                    <span class="text-semibold"><?=$row["name"]?></span>
                                    <div class="txt-subheader" style="font-size: 0.7650rem"><?=$row["amountrecepts"] + $row["amountreceptssaved"]?> recipes</div>
                                </div>
                            </a>
                        <?php endwhile;?>
                    </div>
            </div>
           </div>
        </div>
    </div>
    <?php require $dir.'/elements/main-footer.php';?>
    <script>
        const pageTitle = document.querySelector('#page-title');
        const iconSearch = document.querySelector('#icon-search');
        const btnaddRecipe = document.querySelector("#BtnAddRecipe");
        const btnCancelRecipe = document.querySelector("#btnCancelRecipe");

        pageTitle.innerText = "My Recipes";
        iconSearch.style.display = "none";


        btnaddRecipe.onclick = function (){
          toggleAddRecipe()
        };
        btnCancelRecipe.onclick = function (){
          toggleAddRecipe()
        };
        function toggleAddRecipe(){
          if(addRecipe.classList.contains('addRecipe-show')){
              addRecipe.classList.add("addRecipe-remove");
              addRecipe.classList.remove("addRecipe-show");
          }else {
        
              addRecipe.classList.remove("addRecipe-remove");
              addRecipe.classList.add("addRecipe-show");
          }
        }
    </script>
</body>

</html>
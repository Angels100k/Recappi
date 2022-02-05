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
    <?php
    if ($y === 1) : ?>
        <div class="profile-main main-container shadow row">
            <div class="col-5">
                    <?= dd_img($profileImage, $profileImagetype, '98px', '98px', '', "profile-main-picture") ?>
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-12 row">
                        <div class="col-9">
                            <h1 class="mt-0"><?= $username ?></h1>
                        </div>
                        <div class="col-1">
                            <?php
                            if ($_SESSION["id"] != $id) {
                                ?>  <button onclick="invitefollower(<?= $id ?>, this)" class="button-no-style  p-r"> <?php
                                if ($followingperson == 0) {
                                    echo dd_img("user-plus-solid", "svg", "30px", "30px", "", "profile-user-add");
                                } else {
                                    echo dd_img("user-minus-solid", "svg", "30px", "30px", "", "profile-user-add");
                                }
                                ?> </button> <?php
                            } else {
                                echo "<a href='/edit/profile/'>". dd_img("pen-black", "svg", "30px", "30px", "", ""). "</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-1-3 profile-counter">
                        <div class="text-bold"><?= $recepts ?></div>
                        <div class="txt-medium">recepten</div>
                    </div>
                    <div class="col-1-3 profile-counter">
                        <div class="text-bold"><?=$following?></div>
                        <div class="txt-medium">volgers</div>
                    </div>
                    <div class="col-1-3 profile-counter">
                        <div class="text-bold"><?=$followers?></div>
                        <div class="txt-medium">volgend</div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="text-center col-1-3">
                        <div class="text-bold">Biografie</div>
                    </div>
                    <div class="col-12 mt-1">
                        <div><?= $bio ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($x === 1) : ?>
            <div class="main-container mt-3">
                <?php
                if ($id == $_SESSION["id"]) {
                    $draftrecepts = $sqlQuery->ingredientlist();
                    // if ($draftrecepts->fetchColumn() > 0) {
                        
                ?>

                        <div class="row">
                            <h2 class="text-bold"><?= dd_img("list-ul", "svg", '18px', '18px') ?> <a class="ml-05" href="/shoppinglist">My shopping list</a></h2>
                        </div>
                        <div class="row shadow bg-white p-1 border-small bs-bb mt-05">
                            <?php
                            $countShopList = 0;
                            while ($row = $draftrecepts->fetch()) :
                                echo dd_showshoppinglist($row);
                                $countShopList++;
                            endwhile;
                            if($countShopList === 0){
                                echo "No current items in shopping list";
                            }
                            ?>
                        </div>
                        <?php 
                    $draftrecepts = $sqlQuery->getcookbookdraftbig();
                    // if ($draftrecepts->fetchColumn() > 0) {
                        ?>
                        <div class="row">
                            <h2 class="text-bold"><?= dd_img("pen-black", "svg", '18px', '18px') ?> <span class="ml-05">Drafts</span></h2>
                        </div>
                        <div class="row">
                            <div class="row main-container flex-wrap-no w-100 overflow-x-auto mr--1">
                                <?php
                                $countDraftList = 0;
                                while ($row = $draftrecepts->fetch()):
                                    echo dd_draftrecipebigedit($row);
                                    $countDraftList++;
                                endwhile;
                                if($countDraftList === 0){
                                    echo "No current items in draft";
                                }
                                ?>
                            </div>
                        </div>
                <?php 
                } ?>
                <div class="row">
                    <h2 class="text-bold"><?= dd_img("bars", "svg", '18px', '18px') ?> <span class="ml-05">Cookbook tew</span></h2>
                </div>
                <div class="row mb-4">
                    <?php while ($row = $cookbook->fetch()) : ?>
                        <a href="/profile/<?= $url ?>/<?= $row["name"] ?>" class="txt-black shadow col-12 bg-white p-1 border-small bs-bb mt-05">
                            <div>
                                <span class="text-semibold"><?= $row["name"] ?></span>
                                <div class="txt-subheader" style="font-size: 0.6875rem"><?= $row["amountrecepts"] + $row["amountreceptssaved"]  ?> recipes</div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php elseif ($x === 2) :
            $stmt = $sqlQuery->getcookbookcat($cat, $url);
        ?>
            <div class="row main-container mt-3 mb-4">
                <h2 style="margin-top: -30px; margin-bottom: -80px;"><?= $cat ?></h2>
                <?php
                while ($row = $stmt->fetch()) :
                    echo dd_layout_post($row['id'], $row["recipe"], $row["preptime"], $row["difficulty"], $row["likes"], $row["repsonses"], $row["image"], $row["type"], $row["likeid"], $row["saveid"], $row["userid"]);
                endwhile;
                ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <h1 class="profile-not-found">profile not found</h1>
    <?php endif; ?>
    <?php require $dir.'/elements/main-footer.php';?>
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const btnaddRecipe = document.querySelector("#BtnAddRecipe");
                const btnCancelRecipe = document.querySelector("#btnCancelRecipe");
        
                btnaddRecipe.onclick = function (){
                    console.log("click")
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
            });
        </script>
    <script>
        
        const iconBackArrow = document.querySelector('#icon-back-arrow');
        const iconSearch = document.querySelector('#icon-search');
        const iconNotifications = document.querySelector('#icon-notifications');
        const iconFilter = document.querySelector('#icon-filter');
        const iconSettings = document.querySelector('#icon-settings');
        const iconProfile = document.querySelector('#icon-profile');

        if(iconBackArrow){
            iconBackArrow.style.display = "block";
        }
        if(iconSearch){
            iconSearch.style.display = "none";
        }
        if(iconNotifications){
            iconNotifications.style.display = "block";
        }
        if(iconFilter){
            iconFilter.style.display = "none";
        }
        if(iconSettings){
            iconSettings.style.display = "block";
        }
        if(iconProfile){
            iconProfile.style.display = "none";
        }
        <?php if ($_SESSION["id"] != $id): ?>
            iconSettings.style.display = "none"
        <?php endif; ?>

        var mouseTimer;
        var mouseRelease;
        var urlLink;
        var recipeId;
        var currentElement;

        var spanPrep = document.getElementsByClassName("close")[0];
        var closeBtn = document.getElementById("closeModal");
        var deleteBtn = document.getElementById("deleteModal");
        var editBtns = document.getElementsByClassName("edit-draft-close");

        if(deleteBtn){
            deleteBtn.onclick = function(){
                var data = {
                    "recipeId" : recipeId
                };
                fetch("/request/deleteRecipe.php", {
                    method: 'POST',
                    body: JSON.stringify(data),
                }).then(response => response.json())
                .then(result => {
                    currentElement.remove();
                    document.getElementById("modalAddTag").style.display = "none";
                });
            }
        }
        if(closeBtn){
            closeBtn.onclick = function(){
                closeWindowTag()
            }
        }
        if(spanPrep){
            spanPrep.onclick = function(){
                closeWindowTag()
            }
        }
        

        function closeWindowTag(){
            document.getElementById("modalAddTag").style.display = "none";
        }

        function openModal(link, recipeid, element) { 
            currentElement = element
            mouseRelease = 0;
            urlLink = link;
            recipeId = recipeid;
            console.log("open?")
           
            mouseTimer = window.setTimeout(function() {
                execMouseDown(element);
            },2000);
        }
    
        function mouseUp() { 
            if (mouseTimer) window.clearTimeout(mouseTimer);
            if(mouseRelease != 1){
                console.log("not opened")
                location.href = urlLink;
            }            
        }
    
        function execMouseDown(element) { 
            mouseRelease = 1
            document.getElementById("modalAddTag").style.display = "block";
            document.getElementById("deleteTitle").innerHTML = element.childNodes[3].innerText;
            console.log("open now")
            
        }
    
        for (var i = 0; i < editBtns.length; i++) {
            editBtns[i].addEventListener("mouseup", mouseUp);
        }
    </script>
</body>
</html>
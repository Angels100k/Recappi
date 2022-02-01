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
$likeimg;
if($info["liked"] != 0):
    $likeimg = dd_img("heartfill", "svg", "20px", "20px", "", "");
else:
    $likeimg = dd_img("heartempty", "svg", "20px", "20px", "", "");
endif;
if($recipeid == 0 || $info["draft"] == 1 && $info["userid"] != $_SESSION["id"]){
    header("location: /create/recipe/0");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?=dd_head($title, $extra)?>

</head>

<body style="background-color: var(--background)">
    <?php require $dir.'/elements/navbar/navbar.php';?>
    <div class="main-top row">
        <div class="col text-center">
            <button id="BtnOverview" class="list-main list-main-active button-no-style">
                Overview
            </button>
        </div>
        <div class="col text-center">
            <button id="BtnIngredients" class="list-main list-main button-no-style">
            Ingredients
            </button>
        </div>
        <div class="col text-center">  
            <button id="BtnMethod" class="list-main list-main button-no-style">
            Method
            </button>
        </div>
    </div>
    <div class="main-body homepage-container row flex-wrap-no">
        <div class="pagerecepi">

            <div class=" profile-main mt-2 row shadow">
                <a class="mr-2" href="/profile/<?=$info["name"]?>">
                    <?=dd_img($info["image"], $info["imgtype"], '32px', '32px', '', "profile-main-picture", "", "profileimage", ' data-name="'. $info["image"] .'" data-type="'. $info["imgtype"] .'"')?>
                </a>
                <div>
                    <span class="text-bold"><?= $info["username"] ?></span><br>
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
                <div class="row w-100 mt-1 text-bold">
                    <div class="col text-end mr-2"><button onclick="likepost(`<?=$recipeid?>`, this); return false;"
                            class="button-no-style">
                            <?=$likeimg?><span><?=$info["likes"]?></span>
                        </button></div>
                    <div class="col text">
                        <a class="button-no-style" href="#comments">
                            <img src="/assets/img/svg/comment.svg" width="20px" height="20px">
                        </a>
                        <?=$info["repsonses"]?></div>
                </div>
            </div>



            <div class=" profile-main row shadow mt-5">
                <div class="col-12 text-center text-bold">
                    <?=dd_img("clock", "svg", '32px', '32px');?>
                    <span>Time</span>
                </div>
                <div class="col text-center"><span class="text-bold"> <?=$info["preptime"]?> min</span> Prep</div>
                <div class="col text-center"><span class="text-bold"> <?=$info["cooktime"]?> min</span> cook</div>
            </div>

            <div class="mt-5" id="comments">
                <?php 
                    $comments = $sqlQuery->receppicomments($recipeid);
                    while($row = $comments->fetch()){
                ?>
                <div class="profile-main flex-wrap-no p-1 mt-1 row">
                    <div class="mr-2">
                        <?=dd_img($row["image"], $row["imgtype"], '32px', '32px', '', "profile-main-picture", "", "profileimage", ' data-name="'. $row["image"] .'" data-type="'. $row["imgtype"] .'"')?>
                    </div>
                    <div>
                        <div>
                            <span class="text-bold mr-2"><?= $row["username"] ?></span>
                        </div>
                        <div> <?= $row["comment"] ?> </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="main-container">
                <div class="row mt-2 mb-4">
                    <div class="col mr-2">
                        <input type="text" id="comment" onkeydown="postcommentinput(<?=$recipeid?> ,this)">
                    </div>
                    <button class="button-no-style"
                        onclick="postcomment(<?=$recipeid?>, document.getElementById('comment'))">
                        <?=dd_img("send", "svg", '20px', '20px');?>
                    </button>
                </div>
            </div>
            <div class="main-container pagefriends">

            </div>
            <div class="main-container pagefriends">

            </div>
        </div>
        <div class="pagerecepi">
            <div class="main-container">
                <div class="row mt-2">
                    <div class="col-5 container-buttons button-white r-max bs-bb">
                         <button class="button-no-style lf" id="btnMinrecipeCount">
                            <?=dd_img("minus", "svg", '15px', '15px');?>
                         </button>
                        <span id="convertAmount"><?= $info["portion"] ?></span> 
                        <button class="button-no-style rf" id="btnAddrecipeCount">
                            <?=dd_img("plus", "svg", '15px', '15px');?>
                        </button>

                    </div>
                    <div class="col"><button class="button button-secondary r-max bs-bb rf" id="BtnConvert">convert</button></div>
                </div>    
                <div class="row mt-2">
                    <div class="col text-bold">
                        Ingredients
                    </div>
                </div>        
            </div>
            <div class="row shadow bg-white p-1 border-small bs-bb mt-1">
                <?php 
                $ingredients = $sqlQuery->ingredientlistrecipe($recipeid); 
                $countingredients = 0;
                while($row = $ingredients->fetch()):
                    echo dd_showshoppinglistrecipe($row, $info["portion"]);
                    $countingredients++;
                endwhile;
                if($countingredients == 0){
                    echo "This recipe doesn't seem to have any ingredients";
                }
                
                ?>
            </div>
            <div class="main-container">
                <div class="row mt-1 mb-4">
                    <div class="col">
                    <button class="button bg-primary w-100 txt-white r-max bs-bb popup" id="BtnSaveList">
                    <span class="popuptext" id="myPopup">Items added to shoppinglist</span>    
                    Add to shoppinglist</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="pagerecepi">
            <div class="main-container">
            <h3 class="text-bold">Preperation method</h3>
            </div>

            <div class="row shadow bg-white p-1 border-small bs-bb mt-1">
                <?php 
                 $ingredients = $sqlQuery->ingredientMethodRecipe($recipeid); 
                $countingredients = 0;
                while($row = $ingredients->fetch()):
                     echo dd_preprecipe($row);
                     $countingredients++;
                endwhile;
                 if($countingredients == 0){
                    echo "This recipe doesn't seem to have any preperations";
                }
                 
                ?>

            </div>
        </div>
    </div>
    <div class="main-footer row" id="main-footer">
    <div class="col">
            <div class="text-center" style="height:28px;">
                <button class="button-no-style share-button" type="button" title="Share this recipe">
                    <?= dd_img("share", "svg", "26px", "26px", "", "") ?>
                </button>
            </div>
    </div>
    <?php if($info["userid"] != $_SESSION["id"]){ ?>
    <div class="col">
        <div id="BtnAddRecipe">
            <div class="text-center">
                <button onclick="savepost(`<?= $info['id'] ?>`, this); return false;" class="button-no-style">
                    <div></div>
                    <?php 
                    if($info["saved"] != 0):
                        echo dd_img("savefill", "svg", "26px", "26px", "filter: grayscale(100%);", "");
                    else:
                        echo dd_img("saveempty", "svg", "26px", "26px", "filter: grayscale(100%);", "");
                    endif;
                    ?>
                </button>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if($info["userid"] === $_SESSION["id"]){ ?>
        <div class="col">
            <a href="/edit/recipe/<?= $info["id"] ?>">
                <div class="text-center" style="height:28px;">
                    <?= dd_img("edit-pen", "svg", "26px", "26px", "", "") ?>
                </div>
            </a>
        </div>
    <?php } ?>
</div>
</body>
<script>
const shareButton = document.querySelector('.share-button');

shareButton.addEventListener('click', event => {
  if (navigator.share) { 
   navigator.share({
      title: 'Recipe',
      url: '<?php  echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>'
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(console.error);
    } else {
        alert("Coudnt share, try again later")
    }
});
</script>
<script src="/assets/js/recept.js"></script>
</html>
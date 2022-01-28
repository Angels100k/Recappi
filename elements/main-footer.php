<?php
$color = 0;
if($urlpaths[1] == "recipes"){
    $color = 1; 
}else if($urlpaths[1] == "home" || $urlpaths[1] == ""){
    $color = 2; 
}
?>
<div style="position:absolute;bottom:65px;left:16px;Right:16px;background-color:white;" id="addRecipe" class="addRecipe text-center main-container border-small bs-bb ">
    <p>ADD A RECIPE</p>
    <a class="button txt-white bg-primary w-100 mt-05 r-max bs-bb" href="/create/recipe/0">Write it yourself</a>
    <a class="button txt-white bg-primary w-100 mt-05 r-max bs-bb" href="/create/recipe/0/link">Copy a link</a>
    <a class="button txt-white bg-primary w-100 mt-05 r-max bs-bb" href="/create/recipe/0">Use a photo</a>
    <button class="txt-primary button-no-style" id="btnCancelRecipe">Cancel</button>
    
</div>

<div class="main-footer row" id="main-footer">
    <div class="col">
        <a href="/home">
            <div class="text-center" style="height:28px;">
            <?php 
        if($color == 2){
            echo dd_img("home-red", "svg", "28px", "28px", "", "");
        }else {
            echo dd_img("home-grey", "svg", "28px", "28px", "", "");
        }
        ?>

            </div>
            <div class="text-center">
            home
            </div>
        </a>
    </div>
    <div class="col">
        <div id="BtnAddRecipe">
            <div class="text-center" style="height:28px;">
                <?=dd_img("plus-square", "svg", "28px", "28px", "", "");?>
            </div>
            <div class="text-center">
                Add
            </div>
        </div>
    </div>
    <div class="col">
        <a href="/recipes">
        <div class="text-center" style="height:28px;">
        <?php 
        if($color == 1){
            echo dd_img("book-red", "svg", "28px", "28px", "", "");
        }else {
            echo dd_img("book-grey", "svg", "28px", "28px", "", "");
        }
        ?>
            </div>
            <div class="text-center">
            My recipes
            </div>
        </a>
    </div>
</div>
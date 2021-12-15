<?php
$color = 0;
if($urlpaths[1] == "recipes"){
$color = 1; 
}
?>
<div class="main-footer row">
    <div class="col">
        <a href="/home">
            <div class="text-center" style="height:28px;">
            <?php 
        if($color == 0){
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
    <div class="col"></div>
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
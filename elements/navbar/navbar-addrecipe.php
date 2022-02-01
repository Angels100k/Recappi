<?php
?>
<nav class="main-navbar">
    <div class="navbar-title">
        <a class="icon icon-cross" id="icon-cross" href="/home">
            <img style="height: 50%; width: 50%;" src="/assets/img/svg/cross.svg" alt="left arrow icon">
        </a>
        <span style="margin-left: 25px;margin-top: -3%;" class="page-title" id="page-title"></span>
    </div>



    <div class="navbar-icons">


        <!-- notifications -->
        <a class="icon icon-eye" id="icon-eye" href="/recipe/<?=$urlpaths[3]?>">
            <img style="height: 50%; width: 50%;" src="/assets/img/svg/eye.svg" alt="bell icon">
            <p class="preview-text">preview</p>
        </a>

        <!-- settings -->
        <a class="icon icon-save share-button" id="icon-save" onclick="">
            <img style="height: 50%; width: 50%;" src="/assets/img/svg/save-icon.svg" alt="cog wheel icon">
        </a>

        <!-- filter -->
        <a class="icon icon-trashCan" id="icon-trashCan" onclick="">
            <img style="height: 50%; width: 50%;" src="/assets/img/svg/trash-can.svg" alt="control sliders icon">
        </a>




        <!-- shopping list -->
        <a class="icon icon-bullet-list" id="icon-bullet-list">
            <img src="/assets/img/svg/bullet-list.svg" alt="bullet list icon">
        </a>
    </div>



    <!-- logout -->

</nav>

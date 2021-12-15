<?php
$image ="";
$type = "";
$y = 0 ;
if($_SESSION['id']):
    $stmt = $sqlQuery->getprofileimg($_SESSION["id"]);
    while($row = $stmt->fetch()):
        $navbarlink = $row['name'];
        $navbarimage = $row['image'];
        $navbartype = $row['imgtype'];
        $y++;
    endwhile;
endif;
?>
<nav class="main-navbar">
    <script src="https://kit.fontawesome.com/77487487c5.js" crossorigin="anonymous"></script>
<!-- search -->


<!-- settings -->


<!-- notifications -->


<!-- profile -->
<a href="/profile/<?=$navbarlink?>">
    <?=dd_img($navbarimage, $navbartype, '32px', '32px', '', "profile_picture")?>
</a>
<a href="javascript:void(0);" class="icon icon-slider" id="icon-slider" onclick="myFunction()">
    <i class="fas fa-sliders-h" ></i>
</a>
<a class="icon icon-arrow" id="icon-arrow" onclick="myFunction()">
    <i class="fas fa-chevron-left"></i>
    <span class="page-title">Settings</span>
</a>
<!-- logout -->

</nav>
<div class="topnav col text-right" style="font-size:19px">

    <div id="myLinks">
        <div class="col text-left page-title" style="margin-top: 1.5rem">Social</div>
        <div class="parts shadow">
            <p class="grijs text-settings"><img class="setting-icons" src="/assets/img/svg/user-plus-solid.svg" width="16px" height="16px">Find friend</p>
            <p class="text-settings"><i class="fab fa-facebook setting-icons"></i>Connect with facebook</p>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Notifications</div>
        <div class="parts shadow">
            <p class="grijs text-settings"><i class="far fa-bell setting-icons"></i>Allow notifications</p>
            <p class="text-settings"><i class="far fa-envelope setting-icons"></i>Notifications via email</p>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Privacy</div>
        <div class="parts shadow">
            <p class="text-settings"><i class="fas fa-unlock-alt setting-icons" style="transform: scaleX(-1);"></i>Private account</p>

        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Security</div>
        <div class="parts shadow">
            <p class="text-settings"><img class="setting-icons" src="/assets/img/svg/lock-closed.svg" width="16px" height="16px">My password</p>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">About</div>
        <div class="parts shadow">
            <p class="grijs text-settings"><i class="fas fa-info-circle setting-icons"></i>  Read more about Recappi</p>
            <p class="grijs text-settings"><i class="fas fa-question-circle setting-icons"></i>Get help</p>
            <p class="grijs text-settings"><i class="fas fa-thumbs-up setting-icons"></i>Feedback</p>
            <p class="text-settings"><img class="setting-icons" src="/assets/img/svg/judges-hammer.svg" width="16px" height="16px">Terms and conditions</p>
        </div>

        <div class="col text-left" style="margin-top: 2.625rem;"></div>
        <a href="/webpage/logout.php" class="button r-max bs-bb txt-white text-settings" style="margin: 1rem; background-color: var(--signout);">
            <img class="setting-signout-icon" src="/assets/img/svg/signout.svg" width="23px" height="23px" style="position: absolute; left: 2rem;">
            <span class="page-title">Logout</span>
        </a>
    </div>

</div>
<script>
    function myFunction() {
        const myLinks = document.getElementById("myLinks");
        const mainTop = document.getElementById("main-top");
        const mainFooter = document.getElementById("main-footer");
        const mainBody = document.getElementById("main-body");
        const iconSlider = document.getElementById("icon-slider");
        const iconArrow = document.getElementById("icon-arrow");

        if (myLinks.style.display === "block") {
            iconArrow.style.display = "none";
            iconSlider.style.display = "block";
            myLinks.style.display = "none";
            mainTop.style.display = "flex";
            mainBody.style.display = "flex";
            mainFooter.style.display = "flex";
        } else {
            iconArrow.style.display = "block";
            iconSlider.style.display = "none";
            myLinks.style.display = "block";
            mainTop.style.display = "none";
            mainFooter.style.display = "none";
            mainBody.style.display = "none";
        }
    }
</script>
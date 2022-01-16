<?php
$image = "";
$type = "";
$y = 0;
if ($_SESSION['id']) :
    $stmt = $sqlQuery->getprofileimg($_SESSION["id"]);
    while ($row = $stmt->fetch()) :
        $navbarlink = $row['name'];
        $navbarimage = $row['image'];
        $navbartype = $row['imgtype'];
        $y++;
    endwhile;
endif;
?>
<nav class="main-navbar">
    <div class="navbar-title">
        <a class="icon icon-back-arrow" id="icon-back-arrow">
            <img src="/assets/img/svg/left-arrow.svg" alt="left arrow icon">
        </a>
        <span class="page-title" id="page-title"></span>
    </div>



    <div class="navbar-icons">
        <!-- profile -->
        <a href="/profile/<?= $navbarlink ?>" class="icon-profile" id="icon-profile">
            <?= dd_img($navbarimage, $navbartype, '30px', '30px', '', "profile_picture") ?>
        </a>

        <!-- notifications -->
        <a class="icon icon-notifications" id="icon-notifications" onclick="openNotifications()">
            <img src="/assets/img/svg/bell-white.svg" alt="bell icon">
        </a>

        <!-- settings -->
        <a class="icon icon-settings" id="icon-settings" onclick="openSettings()">
            <img src="/assets/img/svg/cog.svg" alt="cog wheel icon">
        </a>

        <!-- filter -->
        <a class="icon icon-slider" id="icon-filter" onclick="openfilters()">
            <img src="/assets/img/svg/sliders-white.svg" alt="control sliders icon">
        </a>

        <!-- search-->
        <a id="icon-search">
            <div class="search-box">
                <input type="text" id="searchbar" placeholder="Type to search..."/>
                <div class="search-btn icon-search" onclick="searchOpen()">
                    <i class="icon-search"><img src="/assets/img/svg/magnifying-glass.svg"></i>
                </div>

                <div class="cancel-btn icon-search-close" onclick="searchClose()">
                    <i><img src="/assets/img/svg/cross.svg" style="height: 50%; width: 50%;"></i>
                </div>
            </div>
        </a>



        <!-- shopping list -->
        <a class="icon icon-bullet-list" id="icon-bullet-list">
            <img src="/assets/img/svg/bullet-list.svg" alt="bullet list icon">
        </a>
    </div>


    
    <!-- logout -->

</nav>
<div class="search-menu col text-right" id="search-menu">
    <div class="main-container">
        <h2>people:</h2>
    </div> 
    
     <div class="row mb-4 main-container" id="searchResultPeople"></div>

    <div class="main-container">
        <h2>recipe's:</h2>
    </div>
    
    <div class="row mb-4 main-container" id="searchResultRecipe"></div>
</div>
<div class="settings-menu col text-right" id="settings-menu" style="font-size:19px">

    <div id="myLinks">
        <div class="col text-left page-title" style="margin-top: 1.5rem">Social</div>
        <div class="parts shadow">
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/user-plus-solid.svg">
                <span>Find friends</span>
            </div>
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/facebook.svg">
                <span>Connect with Facebook</span>
            </div>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Notifications</div>
        <div class="parts shadow">
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/bell.svg">
                <span>Allow Notifications</span>
            </div>
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/envelope.svg">
                <span>Notifications via email</span>
            </div>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Privacy</div>
        <div class="parts shadow">
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/lock-open.svg" alt="open locket icon">
                <span>Private account</span>
            </div>

        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Security</div>
        <div class="parts shadow">
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/lock-closed.svg">
                <span>My password</span>
            </div>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">About</div>
        <div class="parts shadow">
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/info.svg">
                <span>Read more about Recappi</span>
            </div>
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/question-mark.svg">
                <span>Get help</span>
            </div>
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/thumbs-up.svg">
                <span>Feedback</span>
            </div>
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/judges-hammer.svg">
                <span>Terms and conditions</span>
            </div>
        </div>

        <div class="col text-left" style="margin-top: 2.625rem;"></div>
        <a href="/webpage/logout.php" class="button sign-out-btn r-max bs-bb txt-whitetext-settings" style="margin: 1rem; background-color: var(--signout);">
            <img class="setting-signout-icon" src="/assets/img/svg/signout.svg" style="position: absolute; left: 2rem;">
            <span class="setting-signout-text">Sign Out</span>
        </a>
    </div>
</div>
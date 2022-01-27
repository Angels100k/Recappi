<?php
$image = "";
$type = "";
$private = 0;
$y = 0;
if ($_SESSION['id']) :
    $stmt = $sqlQuery->getprofilenavbarinfo($_SESSION["id"]);
    while ($row = $stmt->fetch()) :
        $navbarlink = $row['name'];
        $navbarimage = $row['image'];
        $navbartype = $row['imgtype'];
        $private = $row['private'];
        $y++;
    endwhile;
endif;
?>
<nav class="main-navbar">
    <div class="navbar-title">
        <?php 
        if($urlpaths[1] === "settings"){
            $backurl = $_SERVER['HTTP_REFERER'] ?? "/home";
            ?>
            <a class="icon" href="<?=$backurl?>">
                <img src="/assets/img/svg/left-arrow.svg" alt="left arrow icon">
            </a>
            <?php
        }else {
            ?>
            <a class="icon icon-back-arrow" id="icon-back-arrow">
                <img src="/assets/img/svg/left-arrow.svg" alt="left arrow icon">
            </a>
            <a class="icon icon-back-arrow" id="icon-back-arrow-2">
                <img src="/assets/img/svg/left-arrow.svg" alt="left arrow icon">
            </a>
            <span class="page-title" id="page-title"></span>
            <?php
        }
        ?>
       
    </div>



    <div class="navbar-icons">
        <!-- profile -->
        <a href="/profile/<?= $navbarlink ?>" class="icon-profile" id="icon-profile">
            <?= dd_img($navbarimage, $navbartype, '30px', '30px', '', "profile_picture") ?>
        </a>
        <!-- settings -->
        <a class="icon icon-settings" id="icon-settings" onclick="openSettings()">
            <img src="/assets/img/svg/cog.svg" alt="cog wheel icon">
        </a>

        <!-- filter
        <a class="icon icon-slider" id="icon-filter" onclick="openfilters()">
            <img src="/assets/img/svg/sliders-white.svg" alt="control sliders icon">
        </a>
        -->
        <!-- search-->
        <a class="search-btn icon-search" onclick="searchOpen()" id="icon-search">
            <i class="icon-search"><img src="/assets/img/svg/magnifying-glass.svg"></i>
        </a>

        <a id="icon-search">
            <div class="search-box">
                <input type="text" id="searchbar" placeholder="Type to search..."/>


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
            <a class="text-settings" href="/search/friend">
                <img class="setting-icon" src="/assets/img/svg/user-plus-solid-black.svg">
                <span>Find friends</span>
            </a>
            <div class="text-settings">
                <img class="setting-icon" src="/assets/img/svg/facebook.svg">
                <span>Connect with Facebook</span>
            </div>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Privacy</div>
        <div class="parts shadow row">
            <div class="text-settings col">
                <img class="setting-icon" src="/assets/img/svg/lock-open.svg" alt="open locket icon">
                <span>Private account</span>
            </div>
            <div class="col d-flex">
                <label class="switch rf-flex">
                    <input id="imgSelfMade" type="checkbox" onclick='updateAccountPrivate(this);' <?php if($private == 1){echo "checked";} ?>>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">Security</div>
        <div class="parts shadow">
            <a class="text-settings" href="/login/forgotpassword">
                <img class="setting-icon" src="/assets/img/svg/lock-closed.svg">
                <span>My password</span>
            </a>
        </div>
        <div class="col text-left page-title" style="margin-top: 2.625rem">About</div>
        <div class="parts shadow">
            <a class="text-settings" target="_blank" href="https://www.recappi.com/about">
                <img class="setting-icon" src="/assets/img/svg/info.svg">
                <span>Read more about Recappi</span>
            </a>
            <a class="text-settings" target="_blank" href="https://www.recappi.com/help">
                <img class="setting-icon" src="/assets/img/svg/question-mark.svg">
                <span>Get help</span>
            </a>
            <a class="text-settings" target="_blank" href="https://www.recappi.com/feedback">
                <img class="setting-icon" src="/assets/img/svg/thumbs-up.svg">
                <span>Feedback</span>
            </a>
            <a class="text-settings" target="_blank" href="https://www.recappi.com/terms">
                <img class="setting-icon" src="/assets/img/svg/judges-hammer.svg">
                <span>Terms and conditions</span>
            </a>
        </div>

        <div class="col text-left" style="margin-top: 2.625rem;"></div>
        <a href="/webpage/logout.php" class="button sign-out-btn r-max bs-bb txt-whitetext-settings" style="margin: 1rem; background-color: var(--signout);">
            <img class="setting-signout-icon" src="/assets/img/svg/signout.svg" style="position: absolute; left: 2rem;">
            <span class="setting-signout-text">Sign Out</span>
        </a>
    </div>
</div>

<script>
    function updateAccountPrivate(element){
        if(element.checked === true){
            item = 1
        }else {
            item = 0
        }
        data = {
            "item": item,
        }
        let opts = {
          method: 'POST',
          body: JSON.stringify(data),
          headers: {
            'content-type': 'application/json'
          },
        };
        fetch('/request/updateprofileprivate.php', opts).then(response => response.json())
        .then(data => {
          console.log(data);
        });
    }
</script>
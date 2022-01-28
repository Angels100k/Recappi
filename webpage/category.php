<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("homepage")?>
</head>

<body style="background-color: var(--background)">
<?php require $dir.'/elements/navbar/navbar.php';?>
    <div id="main-body" class="main-body homepage-container row flex-wrap-no">
        <div class="main-container pagefriends">
            <h2>Category change</h2>
            <div class="row">
                <input type="text" id="categoryname" placeholder="Type to new category..."/>
            </div>
            <a class="button sign-out-btn r-max bs-bb txt-whitetext-settings" style=" margin: 1rem;background-color: var(--signout)">
                <span class="setting-signout-text" id="categorytext"> Create category</span>
            </a>
        </div>
    </div>
    <?php require $dir.'/elements/main-footer.php';?>

    <script src="/assets/js/main.js"></script>
</body>

</html>
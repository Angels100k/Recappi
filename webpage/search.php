<?php 
$title = "settings page recappi"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?=dd_head($title)?>
</head>

<body style="background-color: var(--background)">
    <?php require $dir.'/elements/navbar/navbar.php';?>
    <div class="mt-5 row main-container">
        <input type="text" id="searchFriends" onkeyup="findfriends(this)">
    </div>
    <div class="row main-container" id="friendscontainer">
    </div>
    <?php 
    $query = $urlpaths[2] ?? "";
    switch($query) {
        case 'friend':
        case 'friends':
            echo '<script>
            function findfriends(element){
                const searchResultPeople = document.querySelector("#friendscontainer");
                data = {"item": element.value,"limit": 100}
                let opts = {method: "POST",body: JSON.stringify(data),headers: {"content-type": "application/json"},};
                fetch("/request/getsearchfriends.php", opts).then(response => response.json()).then(data => {searchResultPeople.innerHTML = data;});
            }</script>';
            break;
        default:
            echo "not working";
            break;
    }
    ?>
    <?php require $dir.'/elements/main-footer.php';?>
    <script src="/assets/js/main.js"></script>

    </body>
</html>
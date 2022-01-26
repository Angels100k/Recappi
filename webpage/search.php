<?php 
$title = "search page recappi"
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
            const friendscontainer = document.querySelector("#friendscontainer");
            function findfriends(element){
                if (element.value === "") {
                    friendscontainer.style.display = "none";
                  } else {
                    friendscontainer.style.display = "flex";
                    searchfriend(element.value)
                  }
                
            }
            function searchfriend(val) {
                data = {"item": val,"limit": 100}
                let opts = {method: "POST",body: JSON.stringify(data),headers: {"content-type": "application/json"},};
                fetch("/request/getsearchfriends.php", opts).then(response => response.json()).then(data => {friendscontainer.innerHTML = data;});
            }
            </script>';
            break;
        default:
            echo "not working";
            break;
    }
    ?>
    <?php require $dir.'/elements/main-footer.php';?>
    <script>
        
        const btnaddRecipe = document.querySelector("#BtnAddRecipe");
        const btnCancelRecipe = document.querySelector("#btnCancelRecipe");
        btnaddRecipe.onclick = function (){
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
    </script>

    </body>
</html>
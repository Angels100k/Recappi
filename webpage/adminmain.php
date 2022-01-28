<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("homepage")?>
</head>

<body style="background-color: var(--background)">
<?php 
if($urlpaths[2] == "category"){
    require $dir.'/webpage/category.php';
}else {

?>
<?php require $dir.'/elements/navbar/navbar.php';?>
    <div id="main-top" class="main-top row">
        <div class="col text-center">
        <button id="Btnfriends" class="list-main list-main-active button-no-style">
        Categories
        </button>    
        </div>
        <div class="col text-center">
        <button id="BtnDiscover" class="list-main button-no-style">
        Discover
        </button>    
        </div>
    </div>
    <div id="main-body" class="main-body homepage-container row flex-wrap-no">
        <div class="main-container pagefriends">
            <div class="row">
                <table>
                    <tr>
                        <th><h2>Category</h2></th>
                        <th><h2>edit</h2></th>
                        <th><h2>delete</h2></th>
                    </tr>
                    <?php
                    $stmt = $sqlQuery->getCategories();
                    foreach($stmt as $stmts) {
                        echo"<tr>";
                        echo "<td id='hoi'>". htmlspecialchars($stmts->name)."</td>";
                        echo "<td><a href='/category' class='icon icon-notifications' id='btnedit'>
                                <img src='/assets/img/svg/edit-pen-black.svg' alt='bell icon'>
                              </a></td>";
                        echo "<td><a class='icon icon-notifications' id='icon-notifications'>
                                <img src='/assets/img/svg/trash-can-black.svg' alt='bell icon'>
                              </a></td>";
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a class="button sign-out-btn r-max bs-bb txt-whitetext-settings" href="/admin/category"><span class="setting-signout-text">Create Category</span></a></td>
                        <td></td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="main-container pagediscover mb--4">
            <h2>On Discover Now</h2>
            <div class="row mb-4">
                <?php 
                $stmt = $sqlQuery->getcookbookdiscover();
                while($row = $stmt->fetch()):
                        echo dd_layout_post($row['id'], $row["recipe"], $row["preptime"],$row["difficulty"], $row["likes"], $row["repsonses"], $row["image"], $row["type"], $row["likeid"], $row["saveid"], $row["userid"]);
                    endwhile;
                ?>
            </div>
            <h2>Not Discoverd Yet</h2>
            <div class="row mb-4">
                <input type="text" id="searchbar" placeholder="Type to search..."/>
            </div>
        </div>
    </div>
    <?php
}
?>
    <?php require $dir.'/elements/main-footer.php';?>

    <script src="/assets/js/main.js"></script>
    <script>

    </script>
</body>

</html>
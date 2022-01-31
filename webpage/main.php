<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("homepage")?>
</head>

<body style="background-color: var(--background)">
<?php require $dir.'/elements/navbar/navbar.php';?>
    <div id="main-top" class="main-top row">
        <div class="col text-center">
        <button id="Btnfriends" class="list-main list-main-active button-no-style">
        My friends
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
            <h2 style="margin-bottom: -2rem; ">following</h2>
            <div class="row mb-4">
                <?php 
                    $stmt = $sqlQuery->getfriends();
                    while($row = $stmt->fetch()):
                        echo dd_layout_friend($row);
                    endwhile;
                    ?>
            </div>
        </div>
        <div class="main-container pagediscover mb--4">
            <h2>Recipe feed</h2>
            <div class="row mb-4">
                <?php 
                $stmt = $sqlQuery->getcookbookdiscover();
                while($row = $stmt->fetch()):
                        echo dd_layout_post($row['id'], $row["recipe"], $row["preptime"],$row["difficulty"], $row["likes"], $row["repsonses"], $row["image"], $row["type"], $row["likeid"], $row["saveid"], $row["userid"]);
                    endwhile;
                ?>
            </div>
        </div>
    </div>
    <?php require $dir.'/elements/main-footer.php';?>

    <script src="/assets/js/main.js"></script>
</body>

</html>
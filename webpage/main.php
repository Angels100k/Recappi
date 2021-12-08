<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("homepage")?>
</head>

<body style="background-color: var(--background)">
<?php require $dir.'/elements/navbar.php';?>
    <div class="main-top row txt-primary">
        <div class="col text-center">My friends</div>
        <div class="col text-center">Discover</div>
    </div>
    <div class="main-body homepage-container row flex-wrap-no">
        <div class="main-container pagefriends">
            <h2>following</h2>
            <div class="row">
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

</body>

</html>
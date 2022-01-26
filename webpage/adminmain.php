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
                        echo "<td>". htmlspecialchars($stmts->name)."</td>";
                        echo "<td><a class='icon icon-notifications' id='icon-notifications' onclick='openNotifications()'>
                                <img src='/assets/img/svg/edit-pen.svg' alt='bell icon'>
                              </a></td>";
                        echo "<td><a class='icon icon-notifications' id='icon-notifications' onclick='openNotifications()'>
                                <img src='/assets/img/svg/trash-can-black.svg' alt='bell icon'>
                              </a></td>";
                    }
                    ?>
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
                <?php
                $stmt = $sqlQuery->getcookbooknotdiscover();
                while($row = $stmt->fetch()):
                    echo dd_layout_adminpost($row['id'], $row["recipe"], $row["preptime"],$row["difficulty"], $row["likes"], $row["repsonses"], $row["image"], $row["type"], $row["likeid"], $row["saveid"], $row["userid"]);
                endwhile;
                ?>
            </div>
        </div>
    </div>
    <?php require $dir.'/elements/main-footer.php';?>

    <script src="/assets/js/main.js"></script>
</body>

</html>
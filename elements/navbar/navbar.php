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

<!-- search -->


<!-- settings -->


<!-- notifications -->


<!-- profile -->
<a href="/profile/<?=$navbarlink?>">
    <?=dd_img($navbarimage, $navbartype, '32px', '32px', '', "profile_picture")?>
</a>
<!-- logout -->
    <a href="/webpage/logout.php">Logout</a>
</nav>
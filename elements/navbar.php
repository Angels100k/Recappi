<?php
$image ="";
$type = "";
$y = 0 ;
if($_SESSION['id']):
    $stmt = $sqlQuery->getprofileimg($_SESSION["id"]);
    while($row = $stmt->fetch()):
        $image = $row['image'];
        $type = $row['imgtype'];
        $y++;
    endwhile;
endif;
?>
<nav class="main-navbar">

<!-- search -->


<!-- settings -->


<!-- notifications -->


<!-- profile -->

<?=dd_img($image, $type, '32px', '32px', '', "profile_picture")?>


</nav>
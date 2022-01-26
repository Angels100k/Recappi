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
    <script>
        const settingsMenu = document.querySelector('#settings-menu');
        settingsMenu.style.display = 'block';
    </script>
</html>
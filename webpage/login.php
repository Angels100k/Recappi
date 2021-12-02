<?php 
$style = '<link rel="stylesheet" href="/assets/css/login.css">';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("Login", $style)?>
</head>

<body style="background-color: var(--background)">

    <div class="d-flex jc-center" style="margin-top: 4rem;flex-wrap: wrap;">
        <?=dd_img("logo-red", "svg", "212px","81px", "flex:100%;")?>
        <?=dd_field_wrapper("Welcome back", "h1", "text-center f-100")?>
        <?=dd_field_wrapper("Login to get to your personal cookbook", "h2", "text-center f-100")?>
        <form action="">

            <input type="text" id="email" name="email" placeholder="Your email.."><br><br>

            <input type="password" id="password" name="password" placeholder="Your password.."><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>


</body>
</html>
<?php 
$style = '<link rel="stylesheet" href="/assets/css/login.css">';
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: /start");
}
$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['passwordcheck'];
    $file = 'people.txt';

    if($password === $password2){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $returned = $sqlQuery->registerUser($name, $username, $email, $hashedPassword);
        while($row = $returned->fetch()): 
            if(intval($row["OUT_result"]) == 0){
                    $error = 1;
            }else {
                $_SESSION["id"] = $row["OUT_result"];
                header("Location: /edit/profile");
            }
        endwhile;
    }
}
$url = $urlpaths[2] ?? "";
if($url != ""){
    switch($url) {
        case 'google':
            $x = 1;
            echo "google";
            break;
        case 'email':
            $x = 2;
            break;
            
        case 'facebook':
            $x = 3;
            echo "facebook";
            break;
        default:
            $x = 0;
            require $dir . '/404.php';
            header("HTTP/1.1 404 Not Found");
            break;
    }
}else {
    $x = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?=dd_head("Register", $style)?>
 <style>

 </style>
</head>
<body <?php if($x === 0){
    ?> style="background-color: var(--primary)"<?php }else { ?> style="padding: 0 16px; background-color: var(--background)"<?php }?>>
<?php 
if($x === 0){
    ?>
    <div class="bg-white home-top" style="margin-bottom: 53.5px;">
    <div class="d-flex jc-center home-image">
        <?=dd_img("logo-white-dot", "svg", "212px","81px", "padding:1rem;background-color: var(--primary);border-radius: 1.5rem;")?>
    </div>
    </div>

    <div class="home-bottom">
        <div class="main-container text-center">
            <?=dd_button("Register with Email", "href='/register/email'", "a", "button button-white button-mail r-max bs-bb", "bottom: 55px;position: absolute;left: 16px;right: 16px;")?>
            <?=dd_button("Register with Google", "href='/register/google'", "a", "button button-white button-google r-max bs-bb", "bottom: 105px;position: absolute;left: 16px;right: 16px;")?>
            <?=dd_button("Register with Facebook", "href='/register/facebook'", "a", "button button-white button-facebook r-max bs-bb", "bottom: 155px;position: absolute;left: 16px;right: 16px;")?>
        </div>
    </div>
<?php } elseif($x === 2) {?>

    <div class="d-flex jc-center" style="margin-top: 4rem;flex-wrap: wrap;">
        <?=dd_img("logo-red-dot", "svg", "212px","81px", "flex:100%;")?>
    </div>

    <div class="main-container text-center">
        <?=dd_field_wrapper("Create accout", "h1", "text-center f-100")?>
        <?=dd_field_wrapper("You're just moments away from capturing and sharing your recipes", "h2", "text-center f-100")?>
        <form method="post" style="bottom: 55px;position: absolute;left: 16px;right: 16px;">
            <input required type="text" id="username" name="username" placeholder="Name"><br>
            <input required type="text" id="name" name="name" placeholder="Username" onkeypress="return event.charCode != 32"><br>
            <input required type="text" id="email" name="email" placeholder="Email"><br>
            <input required type="password" id="password" name="password" placeholder="Password"><br>
            <input required type="password" id="passwordcheck" name="passwordcheck" placeholder="Password check"><br>
            <input type="submit" value="Sign up" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb">
        </form>
        <?=dd_button("I already have an account", "href='/login'", "a", "txt-primary", "bottom: 20px;position: absolute;left: 0;right: 0;")?>
    </div>

    

<?php
if($error == 1){
    echo '<script>alert("Username exists")</script>';
}
}?>

</body>
</html>
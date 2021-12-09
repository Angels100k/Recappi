<?php 
$style = '<link rel="stylesheet" href="/assets/css/login.css">';
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: /home");
}

$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
        $returned = $sqlQuery->loginUser($email);
        while($row = $returned->fetch()): 
            if (password_verify($password, $row["password"])) {
                $_SESSION["id"] = $row["id"];
                header("Location: /home");
            } else {
                    $error = 1;
            }
        endwhile;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("Login", $style)?>
</head>

<body style="background-color: var(--background)">

    <div class="d-flex jc-center" style="margin-top: 4rem;flex-wrap: wrap;">
        <?=dd_img("logo-red", "svg", "212px","81px", "flex:100%;")?>
    </div>

    <div class="main-container text-center" style="bottom: 20px;position: absolute;left: 16px;right: 16px;">
        <?=dd_field_wrapper("Welcome back", "h1", "text-center f-100")?>
        <?=dd_field_wrapper("Login to get to your personal cookbook", "h2", "text-center text-normal f-100")?>
        <form method="post">
            <input required type="text" id="email" name="email" placeholder="Email"><br>
            <input required type="password" id="password" name="password" placeholder="Password"><br>
            <?=dd_button("Forgot my password", "href='/login/forgotpassword'", "a", "txt-primary", "")?>
            <input type="submit" value="Log in" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb">
        </form>
        <?=dd_button("No account yet? Create one here", "href='/register'", "a", "txt-primary mt-1")?>
    </div>
</body>
</html>
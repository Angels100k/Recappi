<?php 
$style = '<link rel="stylesheet" href="/assets/css/login.css">';
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
            require __DIR__ . '/404.php';
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
    
</head>
<body <?php if($x === 0){
    ?> style="background-color: var(--primary)"<?php }else { ?> style="padding: 0 16px; background-color: var(--background)"<?php }?>>
<?php 
if($x === 0){
    ?>
    <div class="bg-white home-top" style="margin-bottom: 53.5px;">
    <div class="d-flex jc-center home-image">
        <?=dd_img("logo-white", "svg", "212px","81px", "padding:1rem;background-color: var(--primary);border-radius: 1.5rem;")?>
    </div>
    </div>

    <div class="home-bottom">
        <div class="main-container text-center">
            <?=dd_button("Register with Email", "href='/register/email'", "a", "button txt-black bg-white r-max bs-bb", "bottom: 55px;position: absolute;left: 16px;right: 16px;color:#E03C19;")?>
            <?=dd_button("Register with Google", "href='/register/google'", "a", "button txt-black bg-white r-max bs-bb", "bottom: 105px;position: absolute;left: 16px;right: 16px;")?>
            <?=dd_button("Register with Facebook", "href='/register/facebook'", "a", "button txt-black bg-white r-max bs-bb", "bottom: 155px;position: absolute;left: 16px;right: 16px;color:#237AEF;")?>
        </div>
    </div>
<?php } elseif($x === 2) {?>

    <div class="d-flex jc-center" style="margin-top: 4rem;flex-wrap: wrap;">
        <?=dd_img("logo-red", "svg", "212px","81px", "flex:100%;")?>
    </div>

    <div class="main-container text-center">
        <?=dd_field_wrapper("Create accout", "h1", "text-center f-100")?>
        <?=dd_field_wrapper("You're just moments away from capturing and sharing your recipes", "h2", "text-center f-100")?>
        
        <?=dd_button("Sign up", "href='/register'", "a", "button txt-white bg-primary r-max bs-bb", "bottom: 55px;position: absolute;left: 16px;right: 16px;")?>
        <?=dd_button("I already have an account", "href='/login'", "a", "txt-primary", "bottom: 20px;position: absolute;left: 0;right: 0;")?>
    </div>

<?php }?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<?php
$style = '<link rel="stylesheet" href="./assets/css/main.css">';
?>
<head>
    <?=dd_head("homepage", $style)?>
    <style>
        .container {
            margin: 0 auto;
            text-align: center;
            overflow: hidden;
            max-width: 500px;
        }
        .w3-animate-left {
            left: -500px;
            position: relative;
            animation: animateleft 5s
        }
        @keyframes animateleft {
            0%   {left: -500px;}
            30%  {left: 0;}
            50%  {left: 0;}
            70%  {left: 0;}
            100% {left: 500px;}
        }
    </style>
</head>
<body style="background-color:<?=getenv("COLOR_PRIMARY")?>">
<!-- start top side -->
    <div class="bg-white home-top" style="margin-bottom: 53.5px;">
        <div class="d-flex jc-center home-image">
            <?=dd_img("Logo2", "png", "", "padding:1rem;background-color:". getenv("COLOR_PRIMARY") .";border-radius: 1.5rem;")?>
        </div>
    </div>
<!-- end top side -->

    <div class="container">
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Create your own social cookbook</a>
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Save all your favorite recipes from different sources</a>
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Follow the cookbooks of your loved ones </a>
    </div>

    <div class="main-container">
        <?=dd_button("Create an account", "href='/register'", "a", "button txt-black bg-white r-max w-100 bs-bb")?>
        <?=dd_button("Already have a account? Log in", "href='/login'", "a", "txt-white")?>
    </div>
</body>
<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 5000);
    }
</script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Hello World</title>
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/hello-icon-152.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="white" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Hello World">
    <meta name="msapplication-TileImage" content="images/hello-icon-144.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <?= dd_head("homepage") ?>
    <style>
        .container-slider {
            position: absolute;
            top: 60%;
            left: 0;
            right: 0;
            text-align: center;
            overflow: hidden;
        }

        .w3-animate-left {
            left: -500px;
            position: relative;
            animation: animateleft 10s
        }

        @keyframes animateleft {
            0% {
                left: -100vw;
            }

            30% {
                left: 0;
            }

            50% {
                left: 0;
            }

            70% {
                left: 0;
            }

            100% {
                left: 100vw;
            }
        }
    </style>
</head>

<body style="background-color: var(--primary)">
    <!-- start top side -->
    <div class="bg-white home-top" style="margin-bottom: 53.5px;">
        <div class="d-flex jc-center home-image">
            <?= dd_img("Logo-white", "svg", "212px", "81px", "padding:1rem;background-color: var(--primary);border-radius: 1.5rem;") ?>
        </div>
    </div>
    <!-- end top side -->
    <!-- start bottom side -->
    <div class="home-bottom">
        <div class="container-slider">
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Follow the cookbooks of your hated ones</a>
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Create your own social cookbook</a>
        </div>
        <div style="text-align:center" id="dots">
            <span class="dot" onclick="carousel(0)"></span>
            <span class="dot" onclick="carousel(1)"></span>
            <span class="dot" onclick="carousel(2)"></span>
        </div>

        <div class="main-container text-center">
            <?= dd_button("Create an account", "href='/register'", "a", "button txt-black bg-white r-max bs-bb", "bottom: 55px;position: absolute;left: 16px;right: 16px;") ?>
            <?= dd_button("Already have a account? Log in", "href='/login'", "a", "txt-white", "bottom: 20px;position: absolute;left: 0;right: 0;") ?>
        </div>
    </div>
    <!-- end bottom side -->
</body>
<script>
    var myIndex = 0;
    let timerID;
    var dots = document.getElementById("dots").querySelectorAll(".dot");
    carousel(myIndex);
    console.log(dots);

    function carousel(number) {
        console.log(number);
        dots.forEach(element => element.style.backgroundColor = "red");
        dots[number].style.backgroundColor = "black";
        clearTimeout(timerID)
        myIndex = number;
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex >= x.length) {
            myIndex = 0
        }
        x[myIndex].style.display = "block";
        // setTimeout(function() {;}, 10000);
        timerID = setTimeout(() => {
            carousel(myIndex)
        }, 10000)
    }
</script>
<script src="/assets/js/index.js"></script>
</html>
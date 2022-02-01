<!DOCTYPE html>
<html lang="en">

<head>
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
            <?= dd_img("logo-white-dot", "svg", "212px", "81px", "padding:1rem;background-color: var(--primary);border-radius: 1.5rem;") ?>
        </div>
    </div>
    <!-- end top side -->
    <!-- start bottom side -->
    <div class="home-bottom">
        <div class="container-slider">
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Follow the cookbooks of your loved ones</a>
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Create your own social cookbook</a>
            <a class="mySlides w3-animate-left txt-white" style="width:100%">Save all your favorite recipes from different sources</a>
        </div>
        <div style="text-align:center" id="dots">
            <span class="dot" onclick="carousel(0)"></span>
            <span class="dot" onclick="carousel(1)"></span>
            <span class="dot" onclick="carousel(2)"></span>
        </div>

        <div class="main-container text-center">
            <?php
            $link;
                    if($urlpaths[1] == "" || $urlpaths[1] == "/" || $urlpaths[1] == "index"){
                       $link = "href='/login'";
                    }else {
                        $link = "href='/login?nextUrl=". $url["path"] ."'";
                    }
            ?> 
            <?= dd_button("Create an account", "href='/register'", "a", "button button-white r-max bs-bb", "bottom: 55px;position: absolute;left: 16px;right: 16px;") ?>
            <?= dd_button("Already have a account? Log in", $link, "a", "txt-white", "bottom: 20px;position: absolute;left: 0;right: 0;") ?>
        </div>
    </div>
    <!-- end bottom side -->
</body>
<script>
    var myIndex = 0;
    let timerID;
    var dots = document.getElementById("dots").querySelectorAll(".dot");
    carousel(myIndex);

    function carousel(number) {
        number);
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
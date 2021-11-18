<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<body>
    <div class="container">
        <a class="mySlides w3-animate-left" style="width:100%">Create your own social cookbook</a>
        <a class="mySlides w3-animate-left" style="width:100%">Save all your favorite recipes from different sources</a>
        <a class="mySlides w3-animate-left" style="width:100%">Follow the cookbooks of your loved ones </a>
    </div>

    <button>Create an account</button>
    <a>Already have a account? Log in</a>
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
<?php 
$title = 'edit Recipe';
$recipeName ="";
$image ="";
$type ="";
$description = "";
$preptime = 0;
$cooktime = 0;
$waittime = 0;
$made = 0;
$catid = 0;
$difficulty = 0;
if ($urlpaths[3]) {
    $stmt = $sqlQuery->getRecipeEdit($urlpaths[3]);
    
        while($row = $stmt->fetch()){
        $recipeName = $row["recipe"];
        $image = $row["image"];
        $type = $row["type"];
        $made = $row["made"];
        $description = $row["description"];
        $difficulty = $row["difficulty"];
        $catid = $row["categoryid"];
        $preptime = $row["preptime"];
        $cooktime = $row["cooktime"];
        $waittime = $row["waittime"];

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head($title, '<link rel="stylesheet" href="/assets/css/profile-edit.css">')?>
</head>

<body style="background-color: var(--background)">
    <div id="container1">
        <div class="main-container d-grid">
            <input required type="text" value="<?=$recipeName?>" id="recipeName" name="recipeName"
                placeholder="Name recipe"><br>
            <div class="row mb-4">
                <div class="col">
                    <?=dd_img($image, $type, "150px", "150px", "", "border-small object-cover"); ?>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <p>Did you make this photo yourself?</p>

                        </div>
                        <div class="col">
                            <label class="switch rf">
                                <input type="checkbox" <?php  if($made) echo "checked"; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-bold">
                Decription (optional)
            </span>
            <textarea id="" cols="30" rows="10"
                placeholder="Add a short description about your recipe.."><?=$description?></textarea>
            <span class="text-bold mt-2">
                Duration
            </span>
        </div>
        <div class="profile-main mt-2 row shadow">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <p>Preparation time</p>
                    </div>
                    <div class="col">
                            <?php 
                            $preptimehours = intval($preptime) / 60;
                            $preptimehours = intval($preptime) / 60;
                            $preptimeArray = explode('.', $preptimehours);
                            $preptimeminutes = doubleval("1." . $preptimeArray[1]);
                            ?>
                        <input id="appt-time" type="time" class="timer rf" name="appt-time" value='<?php if($preptimehours < 10) echo("0"); echo(intval($preptimehours)) . ":" . intval(($preptimeminutes * 60) - 60) ?>'>

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row mt-1">
                    <div class="col">
                        <p>Cook time</p>
                    </div>
                    <div class="col">
                        <!-- <div class="rf timer"> -->
                            <?php 
                            $cooktimehours = intval($cooktime) / 60;
                            $cooktimeArray = explode('.', $cooktimehours);
                            $cooktimeminutes = doubleval("1." . $cooktimeArray[1]);
                            // echo(intval($cooktimehours)) . ":" . intval(($cooktimeminutes * 60) - 60);
                            ?>
                        <!-- </div> -->
                        <input id="appt-time" type="time" class="timer rf" name="appt-time" value='<?php if($cooktimehours < 10) echo("0"); echo(intval($cooktimehours)) . ":" . intval(($cooktimeminutes * 60) - 60) ?>'>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row mt-1">
                    <div class="col">
                        <p>Total time</p>
                    </div>
                    <div class="col">
                            <?php 
                            $totaltime = $preptime + $cooktime;
                            $totaltimehours = intval($totaltime) / 60;
                            $totaltimeArray = explode('.', $totaltimehours);
                            $totaltimeminutes = doubleval("1." . $totaltimeArray[1]);
                            ?>
                        <input id="appt-time" type="time" class="timer rf" name="appt-time" value='<?php if($totaltimehours < 10) echo("0"); echo(intval($totaltimehours)) . ":" . intval(($totaltimeminutes * 60) - 60) ?>'>
                            
                    </div>
                </div>
            </div>
        </div>
        <div class="main-container mt-2">
            <span class="text-bold">
                Amounts
            </span>
        </div>
        <div class="profile-main mt-2 row shadow">
            <div class="col-12">
                <p>Amount of portions</p>
                <div class="slidecontainerAmount">
                    <input type="range" min="1" max="100" value="50" class="sliderAmount" id="myRange">

                </div>
            </div>
        </div>
            <div class="main-container mt-2">
                <span class="text-bold">
                    Difficulty
                </span><br>
                <div id="dificultycontainer"><?php 
             for ($x = 0; $x <= $difficulty; $x++):
                 echo "<button onclick='dificultychange(`".($x + 1)."`)' class='button-no-style'><span class='txt-primary dificultychoice fs-3 mr-02'>&#9679</span></button>";
             endfor;
             for ($y = $x; $y <= 4; $y++):
                echo "<button onclick='dificultychange(`".($y + 1)."`)' class='button-no-style '><span class='txt-primary dificultychoice op-30 fs-3 mr-02'>&#9679</span></button>";
             endfor;
            ?><div><div></div></div></div>
        <div class="main-container mt-2">
            <span class="text-bold">
                TAGS
            </span><br>
            <button class="bg-white button ml-05 r-max border-primary">+</button>
                <?php
               $stmt = $sqlQuery->getAllTags();
    
               while($row = $stmt->fetch()){
                  
                   echo '<button onclick="addtag(`'.$row["tag"].'`, this)" class="bg-white button ml-05 r-max border-primary">'.$row["tag"].'</button>';
               }
            ?>
        </div>
        <div class="main-container mt-2 mb-4">
            <span class="text-bold">
                Category
            </span>
            <select name="catgories" id="catgories">
                <option value="" disabled <?php if($catid === 0) echo "selected" ?>>Category</option>
                <?php
               $stmt = $sqlQuery->getAllCategory();
    
               while($row = $stmt->fetch()){
                   if($catid == $row["id"]) {
                       $select = "selected";
                   }else {
                    $select = "";
                   }
                   echo '<option '.$select.'  value="'.$row["id"].'">'.$row["name"].'</option>';
               }
            ?>
            </select>
        </div>
    </div>
    <div id="container2">

    </div>
    <div id="container3">

</div>
    <button class="button button-white r-max bs-bb br-button">
        <?= dd_img("chevron-right", "svg", "20px", "20px", "") ?>
    </button>

    <script>
        function dificultychange(which){
            var container = document.getElementById("dificultycontainer").childNodes;
            for (var i = 1; i < container.length; ++i) {
                var item = container[(i)].childNodes[0]; 
                if(i < which){
                    item.classList.remove("op-30");
                }else {
                    item.classList.add("op-30");
                }
            }
        }
        function addtag(tagname, button) {
            console.log(tagname)
            button.classList.toggle("bg-primary");
            button.classList.toggle("txt-white");
        }
    </script>
</body>
</html>
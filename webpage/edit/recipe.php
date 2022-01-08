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
$portions = 0;
$catid = 0;
$difficulty = 0;
if ($urlpaths[3] && $urlpaths[3] != 0) {
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
        $portions = $row["portion"];

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head($title, '<link rel="stylesheet" href="/assets/css/profile-edit.css">')?>
    <script>
        var recipeId = <?=$urlpaths[3]?>
    </script>
</head>

<body style="background-color: var(--background)">
<div id="modalPrepTime" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>

        <select  id="prepTimeHours">
            <option value="00">00</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
        </select>
    </div>
    <div>
        <select id="prepTimeMinutes">
            <option value="00">00</option>
            <option value="05">05</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
        </select>
    </div>
    <div>
        <button id="SavePrepTime" class="timer rf" >accept</button>
    </div>
  </div>

</div>
<div id="modalCookTime" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>

        <select  id="cookTimeHours">
            <option value="00">00</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
        </select>
    </div>
    <div>
        <select id="cookTimeMinutes">
            <option value="00">00</option>
            <option value="05">05</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
        </select>
    </div>
    <div>
        <button id="SaveCookTime" class="timer rf" >accept</button>
    </div>
  </div>

</div>
<div id="modalAddTag" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <input type="text" id="inputAddTag" maxlength="25">
    <div>
        <button id="SaveTagModelBtn" class="timer rf" >accept</button>
    </div>
  </div>

</div>
<div class="pagerecepi" id="container1">
        <div class="main-container d-grid">
            <input required type="text" value="<?=$recipeName?>" id="recipeName" name="recipeName"
                placeholder="Name recipe"><br>
            <div class="row mb-4">
                <div class="col">
                    <?=dd_img($image, $type, "150px", "150px", "", "border-small object-cover", "", "recipeimage", ' data-name="'. $image .'" data-type="'. $type .'"'); ?>
                    <div class="col-12">
                        <div class="choose_file txt-primary text-bold">
                            <span>add/change photo</span>
                            <input id="recipepic" name="Select File" type="file" accept="image/png, image/wbp, image/jpeg" />
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <p>Did you make this photo yourself?</p>

                        </div>
                        <div class="col">
                            <label class="switch rf">
                                <input id="imgSelfMade" type="checkbox" <?php  if($made) echo "checked"; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-bold">
                Decription (optional)
            </span>
            <textarea id="txtDescription" cols="30" rows="10"
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
                            $preptimehours = intval($preptime / 60.00);
                            $preptimeminutes = intval($preptime  - $preptimehours * 60);
                            ?>
                            <div id="btnPrepTime" class="timer rf">
                            <?php if($preptimehours < 10) echo("0"); echo(intval($preptimehours)) . ":" ; if($preptimeminutes < 10) echo("0"); echo $preptimeminutes ?>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row mt-1">
                    <div class="col">
                        <p>Cook time</p>
                    </div>
                    <?php 
                            $cooktimehours = intval($cooktime / 60.00);
                            $cooktimeminutes = intval($cooktime  - $cooktimehours * 60);
                            ?>
                    <div class="col">
                        <div id="btnCookTime" class="timer rf">
                             <?php if($cooktimehours < 10) echo("0"); echo(intval($cooktimehours)) . ":" ; if($cooktimeminutes < 10) echo("0"); echo $cooktimeminutes ?>
                        </div>
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
                            $totaltimehours = intval($totaltime / 60.00);
                            $totaltimeminutes = intval($totaltime  - $totaltimehours * 60);
                            ?>
                        <div id="totalTime" class="timer rf">
                             <?php if($totaltimehours < 10) echo("0"); echo(intval($totaltimehours)) . ":" ; if($totaltimeminutes < 10) echo("0"); echo $totaltimeminutes ?>
                        </div>
                            
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
                    <input type="range" min="1" max="20" value="<?=$portions?>" class="sliderAmount" id="rangePortions">
                </div>
                <div class="txt-subheader">
                    <div>1 <div class="rf">20</div></div>
                    
                </div>
            </div>
        </div>
            <div class="main-container mt-2">
                <span class="text-bold">
                    Difficulty
                </span><br>
                <div id="dificultycontainer"><?php 
             for ($x = 0; $x < $difficulty; $x++):
                 echo "<button onclick='dificultychange(`".($x + 1)."`)' class='button-no-style'><span class='txt-primary dificultychoice fs-3 mr-02'>&#9679</span></button>";
             endfor;
             for ($y = $x; $y <= 4; $y++):
                echo "<button onclick='dificultychange(`".($y + 1)."`)' class='button-no-style '><span class='txt-primary dificultychoice op-30 fs-3 mr-02'>&#9679</span></button>";
             endfor;
            ?><div><div></div></div></div></div>
        <div class="main-container mt-2" id="tagContainer"><span class="text-bold">
                TAGS
            </span><br><button id="AddTag" class="bg-white button ml-05 r-max border-primary">+</button><?php
               $stmt = $sqlQuery->getAllTags($urlpaths[3]);
    
               while($row = $stmt->fetch()){
                  
                   echo '<button onclick="addtag(`'.$row["tag"].'`, this)" class="bg-white button ml-05 r-max '. $row["class"] . ' border-primary">'.$row["tag"].'</button>';
               }
            ?></div>
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
<div class="pagerecepi" id="container2" style="display:none;">
    <div class="main-container d-grid">
        <p class="text-bold">Ingredients <?= dd_img("bars", "svg", "20px", "20px", "", "rf") ?></p>
    </div>
    <div class="row shadow bg-white p-1 border-small bs-bb mt-05" id="ingredientContainer">
        <?php
            $draftrecepts = $sqlQuery->ingredientlistRecipe($urlpaths[3]);
            while ($row = $draftrecepts->fetch()) :
                echo dd_showingradientlist($row);
            endwhile;
        ?>
    </div>
    <div class="main-container d-grid">
        <p class="text-bold">Add amount</p>
        <input type="number" id="ingredientAmount" placeholder="Add amount">
    </div>
    
    <div class="main-container d-grid">
        <p class="text-bold">Add unit</p>
        <input type="text" id="ingredientUntit" placeholder="Add unit">
    </div>
    <div class="main-container d-grid">
        <p class="text-bold">Add ingredient</p>
        <input type="text" placeholder="Add ingredient" id="ingredientDesc" list="ingredients">
        <datalist id="ingredients">
            <?php
                $draftrecepts = $sqlQuery->ingredientTypes();
                while ($row = $draftrecepts->fetch()) : 
                    echo '<option data-value="'.$row["id"].'">'.$row["ingredient"].'</option>';
                endwhile;
            ?>
        </datalist>
    </div>
    <div class="main-container d-grid">
                <a class="mt-2 text-end text-bold txt-primary" id="addIngredient">Add ingredient</a>
</div>

</div>
<div class="pagerecepi" id="container3"style="display:none;">

</div>
<button id="BtnPrev" class="button button-white r-max bs-bb bl-button" style="display:none">
    <?= dd_img("chevron-left", "svg", "20px", "20px", "") ?>
</button>
<button id="BtnNext" class="button button-white r-max bs-bb br-button">
    <?= dd_img("chevron-right", "svg", "20px", "20px", "") ?>
</button>
<script>
var totalCookTime = <?=$cooktime?>;
var totalPrepTime = <?=$preptime?>;
var difficulty = <?=$difficulty?>;
var totaltime = totalCookTime + totalPrepTime;
var tagBtn = document.getElementById("AddTag");
var btnNext = document.getElementById("BtnNext");
var BtnPrev = document.getElementById("BtnPrev");
var btnCook = document.getElementById("btnCookTime");
var btnPrep = document.getElementById("btnPrepTime");
var modalTag = document.getElementById("modalAddTag");
var modalCook = document.getElementById("modalCookTime");
var modalPrep = document.getElementById("modalPrepTime");
var acceptBtnCook = document.getElementById("SaveCookTime");
var acceptBtnPrep = document.getElementById("SavePrepTime");
var addIngredient = document.getElementById("addIngredient");
var tagBtnAccept = document.getElementById("SaveTagModelBtn");
var spanPrep = document.getElementsByClassName("close")[0];
var spanCook = document.getElementsByClassName("close")[1];
var tagBtnClose = document.getElementsByClassName("close")[2];

function dificultychange(which){
    difficulty = which;
    var container = document.getElementById("dificultycontainer").childNodes;
    for (var i = 0; i < container.length; ++i) {
        var item = container[(i)].childNodes[0]; 
        if(i < which){
            item.classList.remove("op-30");
        }else {
            item.classList.add("op-30");
        }
    }
}

function addtag(tagname, button) {
    button.classList.toggle("bg-primary");
    button.classList.toggle("txt-white");
}

function closeWindowPrep(){
    modalPrep.style.display = "none";
}
function updateTime(){
    var newCookTime = (parseInt(btnCook.innerText.substring(0, 2)) * 60) + parseInt(btnCook.innerText.substring(btnCook.innerText.length - 2));
    var newPrepTime = (parseInt(btnPrep.innerText.substring(0, 2)) * 60) + parseInt(btnPrep.innerText.substring(btnPrep.innerText.length - 2));
    var totaltext = "";

    totalCookTime = newCookTime;
    totalPrepTime = newPrepTime;
    totaltime = totalCookTime + totalPrepTime;

    var totaltimehours = parseInt(totaltime / 60.00);
    var totaltimeminutes = parseInt(totaltime  - totaltimehours * 60);
    if(totaltimehours < 10){ totaltext += "0"}; 
    totaltext += totaltimehours + ":" ; 
    if(totaltimeminutes < 10) {totaltext +="0"}; 
    totaltext +=totaltimeminutes;

    document.getElementById("totalTime").innerHTML = totaltext;

}

function closeWindowCook(){
    modalCook.style.display = "none";
}

function closeWindowTag(){
    modalTag.style.display = "none";
}

addIngredient.onclick = function() {
    var ingredientContainer = document.getElementById("ingredientContainer");
    var ingredientAmount = document.getElementById("ingredientAmount");
    var ingredientUntit = document.getElementById("ingredientUntit");
    var ingredientDesc = document.getElementById("ingredientDesc");
    var ingredientsOptions = document.getElementById("ingredients");

    var data = {
        "ingredientAmount" : ingredientAmount.value,
        "ingredientUntit"  : ingredientUntit.value,
        "ingredientDesc"  : ingredientDesc.value,
        "recipeId" : recipeId
    }
    fetch("/request/addIngredient.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
            console.log(result)
            // var array = JSON.parse(result);

            ingredientContainer.innerHTML = "";
            result[0].forEach(async function(rating) {
                ingredientContainer.innerHTML += rating;
            })
            ingredientsOptions.innerHTML = "";
            result[1].forEach(async function(rating) {
                ingredientsOptions.innerHTML += rating;
            })

            ingredientAmount.value = "";
            ingredientUntit.value = "";
            ingredientDesc.value = "";
        });
};

btnPrep.onclick = function() {
    modalPrep.style.display = "block";
  console.log(btnPrep.innerText.length)
  document.getElementById("prepTimeHours").value = btnPrep.innerText.substring(0, 2);
  document.getElementById("prepTimeMinutes").value = btnPrep.innerText.substring(btnPrep.innerText.length - 2);
}

spanPrep.onclick = function() {
    closeWindowPrep();
}

acceptBtnPrep.onclick = function() {
    closeWindowPrep();
    btnPrep.innerHTML = document.getElementById("prepTimeHours").value + ":" + document.getElementById("prepTimeMinutes").value
    updateTime();
}

btnCook.onclick = function() {
    modalCook.style.display = "block";
  console.log(btnCook.innerText.length)
  document.getElementById("cookTimeHours").value = btnCook.innerText.substring(0, 2);
  document.getElementById("cookTimeMinutes").value = btnCook.innerText.substring(btnCook.innerText.length - 2);
}

spanCook.onclick = function() {
    closeWindowCook();
}
acceptBtnCook.onclick = function() {
    closeWindowCook();
    btnCook.innerHTML = document.getElementById("cookTimeHours").value + ":" + document.getElementById("cookTimeMinutes").value
    updateTime();
}

window.onclick = function(event) {
  if (event.target == modalCook) {
    closeWindowCook();
  }
  if (event.target == modalPrep) {
    closeWindowPrep();
  }
  if (event.target == modalTag) {
    closeWindowTag();
  }
}

tagBtnClose.onclick = function() {
    closeWindowTag();
}

tagBtnAccept.onclick = function() {
    closeWindowTag();
    var tag = document.getElementById("inputAddTag").value

    var data = {"tag":tag}
    fetch("/request/addtag.php", {
        method: 'POST',
        body: JSON.stringify(data),
      }).then(response => response.json())
      .then(result => {
            const e = document.createElement("button");
            e.innerHTML = result;
            e.classList.add("bg-white");
            e.classList.add("button");
            e.classList.add("ml-05");
            e.classList.add("r-max");
            e.classList.add("border-primary");
            e.setAttribute("onclick","addtag(`"+ result +"`, this)");
            document.getElementById("tagContainer").appendChild(e);
            document.getElementById("inputAddTag").value = "";
    });

}

tagBtn.onclick = function() {
    modalTag.style.display = "block";
    document.getElementById("inputAddTag").focus();
}

btnNext.onclick = function() {
    var container1 = document.getElementById("container1");
    var container2 = document.getElementById("container2");
    var container3 = document.getElementById("container3");

    var recipeName = document.getElementById("recipeName").value;
    var imgMade = document.getElementById("imgSelfMade").checked;
    var description = document.getElementById("txtDescription").value;
    var portions = document.getElementById("rangePortions").value;
    var categories = document.getElementById("catgories");
    var categorie = categories.options[categories.selectedIndex].value

    if(container1.style.display == ""){
        var tags = []

        var tagcontainer = document.getElementById("tagContainer");

        for (var i = 0; i < tagcontainer.childNodes.length; i++) {
            if (tagcontainer.childNodes[i].classList.contains("bg-primary")) {
                note = tagcontainer.childNodes[i].innerText;
                tags.push(note);
            }        
        }

        // console.log(data);
        profilesave().then(response => {
            response.push(imgMade)
            var data = {
            "recipeId": <?=$urlpaths[3]?>,
            "recipeName": recipeName,
            "imgMade": imgMade,
            "description": description,
            "preptime":totalPrepTime,
            "cooktime":totalCookTime,
            "portions":portions,
            "difficulty":difficulty,
            "tags":tags,
            "category":categorie,
            "images":[response],
        };
            fetch("/request/updateRecipe.php", {
                method: 'POST',
                body: JSON.stringify(data),
            }).then(response => response.json())
            .then(result => {
                if(<?=$urlpaths[3]?> === 0){
                    recipeId = result;
                    window.history.pushState("", "edit recipe", "/edit/recipe/" + result);
                }
            });
        }
        );

        BtnPrev.style.display = '';
        container1.style.display = 'none';
        container2.style.display = '';
        container3.style.display = 'none';   
    }else if(container2.style.display == ''){
        console.log("con2")
    }else if (container3.style.display == 'block'){

    }
}

</script>

<script src="/assets/js/recipe-edit.js"></script>
</body>
</html>
<?php 
$title = 'edit Recipe';
$recipeName ="";
$image ="";
$type ="";
$link = "";
$description = "";
$preptime = 0;
$cooktime = 0;
$waittime = 0;
$made = 0;
$portions = 0;
$catid = 0;
$currentstep = 0;
$difficulty = 0;
$count = 0;

if ($urlpaths[3] && $urlpaths[3] != 0) {
    $stmt = $sqlQuery->getRecipeEdit($urlpaths[3]);
    
    while($row = $stmt->fetch()){
        $count++;
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
        $link = $row["link"];
    }
    if($count === 0){
        header("Location: /create/recipe/0");
    }
}
if($link === ""){
    $link =  $urlpaths[4] ?? "";
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
<?php require $dir.'/elements/navbar/navbar-addrecipe.php';?>
<div id="modalPrepTime" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>
        <p>Hours</p>
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
        <p>Minutes</p>
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
        <button id="SavePrepTime" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb" >accept</button>
    </div>
  </div>

</div>
<div id="modalCookTime" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>
        <p>Hours</p>
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
        <p>Minutes</p>
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
        <button id="SaveCookTime" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb" >accept</button>
    </div>
  </div>

</div>
<div id="modalAddTag" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Tag name</p>
    <input type="text" id="inputAddTag" maxlength="25">
    <div>
        <button id="SaveTagModelBtn" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb" >accept</button>
    </div>
  </div>

</div>
<div class="pagerecepi" id="container1">
        <div class="main-container d-grid">
            <?php if($link != ""): ?>
                <p class="text-bold">Link</p>
                <input required type="text" value="<?php if($link != "link"): echo $link; endif; ?>" id="recipeLink"
                placeholder="Copy the link"><br>
            <?php endif; ?>
            <p class="text-bold">Name</p>
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
                    <p>Current Amount: <span id="huidigeWaarde">  </span></p>
                    
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
            </span><br><button id="AddTag" class="mt-1 bg-white button ml-05 r-max border-primary">+</button><?php
               $stmt = $sqlQuery->getAllTags($urlpaths[3] ?? 0);
    
               while($row = $stmt->fetch()){
                  
                   echo '<button onclick="addtag(`'.$row["tag"].'`, this)" class="mt-1 bg-white button ml-05 r-max '. $row["class"] . ' border-primary">'.$row["tag"].'</button>';
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
            $ingredientlist = 0;
            while ($row = $draftrecepts->fetch()) :
                echo dd_showingradientlistedit($row);
                $ingredientlist++;
            endwhile;
            if($ingredientlist == 0 ){
                echo "Currently no ingredients added";
            }
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
    <div class="main-container d-flex mb-4">
        <a class="mt-2 text-end text-bold txt-primary d-none" data-id="0" id="cancelIngredient">Cancel</a>
        <a class="mt-2 text-end ml-auto text-bold txt-primary" data-id="0" id="addIngredient">Add ingredient</a>
    </div>

</div>
<div class="pagerecepi" id="container3"style="display:none;">
    <div class="main-container d-grid">
        <p class="text-bold">Method <?= dd_img("bars", "svg", "20px", "20px", "", "rf") ?></p>
    </div>

    <div class="row shadow bg-white p-1 border-small bs-bb mt-1" id="methodContainer">
        <?php 
            $ingredients = $sqlQuery->ingredientMethodRecipe($urlpaths[3]); 
            $ingredientMethod = 0;
            while($row = $ingredients->fetch()):
                echo dd_preprecipeedit($row);
                $currentstep = $row["step"];
                $ingredientMethod++;
            endwhile;
            if($ingredientMethod == 0){
                echo "Currently no preparations added";
            }
        ?>
    </div>

    <div class="main-container mt-3" id="ingredientsContainer">
       
    </div>
    <div class="main-container mt-3">
        <p class="">Tap the ingredients to add them</p>
    </div>
    <div class="main-container mt-3">
        <p class="text-black text-bold">Steps</p>
    </div>
    <div class="main-container mt-3">
        <div>
            <div id="methodStep" class="bg-white  button ml-05 r-max border-primary mr-1"><?php echo $currentstep + 1 ?></div>
            <input type="text" id="methodText" class="w-auto" placeholder="Add step">
            <div onclick="methodStepAdd()" class="bg-white button ml-05 r-max border-primary">+</div>
        </div>
    </div>
    <div class="main-container mt-3 mb-4">
        <button id="publishRecipe" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb">Publish recipe</button>
    </div>
</div>
<button id="BtnPrev" class="button button-white r-max bs-bb bl-button" style="display:none">
    <?= dd_img("chevron-left", "svg", "20px", "20px", "") ?>
</button>
<button id="BtnNext" class="button button-white r-max bs-bb br-button" style="display: flex">
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
var publishRecipe = document.getElementById("publishRecipe");
var addIngredient = document.getElementById("addIngredient");
var tagBtnAccept = document.getElementById("SaveTagModelBtn");
var spanPrep = document.getElementsByClassName("close")[0];
var spanCook = document.getElementsByClassName("close")[1];
var tagBtnClose = document.getElementsByClassName("close")[2];

function editPrepMethodRecipe(item1, item2, container){
    document.getElementsByTagName("BODY")[0].innerHTML += 
      `    <div id="modalMethod" style="display:block;" class="modal">
      <div class="modal-content">
        <span class="close" onclick="document.getElementById('modalMethod').remove();">&times;</span>
        <p class="text-bold">Select catogory to save recipe</p>
        <div>
            <div id="modalMethodStep" class="bg-white  button ml-05 r-max border-primary mr-1">`+item1+`</div>
            <input type="text" id="modalMethodText" class="w-auto" placeholder="Add step" value="`+item2+`">
            <div onclick="modalMethodStepAdd(document.getElementById('modalMethod'))" class="bg-white button ml-05 r-max border-primary">+</div>
        </div>
        <div>
            <button id="closeModal" onclick="document.getElementById('modalMethod').remove();" class="timer rf" >cancel</button>
        </div>
      </div>
      </div>`;
}

function modalMethodStepAdd(modal){
    var step = document.getElementById("modalMethodStep").innerHTML;
    var methodText = document.getElementById("modalMethodText").value;

    var data = {
       "methodText" : methodText,
       "recipeId" : recipeId,
       "step" : step
    }

    fetch("/request/editMethod.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
            
            methodContainer.innerHTML = "";

            result[0].forEach(async function(rating) {
                methodContainer.innerHTML += rating;
            })
            modal.remove();
        });
}

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
    var ingredientsContainer = document.getElementById("ingredientsContainer");
    var ingredientAmount = document.getElementById("ingredientAmount");
    var ingredientUntit = document.getElementById("ingredientUntit");
    var ingredientDesc = document.getElementById("ingredientDesc");
    var ingredientsOptions = document.getElementById("ingredients");

    var data = {
        "ingredientAmount" : ingredientAmount.value,
        "ingredientUntit"  : ingredientUntit.value,
        "ingredientDesc"  : ingredientDesc.value,
        "recipeId" : recipeId,
        "id": addIngredient.dataset.id,
    }
    fetch("/request/addIngredient.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
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
            document.getElementById("addIngredient").innerHTML = "Add ingredient";
            document.getElementById("addIngredient").dataset.id = 0;
            document.getElementById("cancelIngredient").classList.add("d-none");
        });
};

publishRecipe.onclick = function() {
    
    var data = {
       "recipeId" : recipeId
    }

    fetch("/request/publishRecipe.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
            location.href = "/recipe/" + recipeId
        });
}

function methodStepAdd() {
    var methodText = document.getElementById("methodText");
    var methodStep = document.getElementById("methodStep");

    var data = {
       "methodText" : methodText.value,
       "methodStep" : methodStep.innerText,
       "recipeId" : recipeId,
    }

    fetch("/request/addMethod.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
            
            methodContainer.innerHTML = "";

            result[0].forEach(async function(rating) {
                methodContainer.innerHTML += rating;
            })

            methodStep.innerText = parseInt(result[1]) + 1;
            methodText.value = "";
        });
}

btnPrep.onclick = function() {
    modalPrep.style.display = "block";
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
if(document.getElementById("container1").style.display != 'none' ){
    const pageTitle = document.querySelector(".page-title");
    pageTitle.innerText = 'add recipe';
}

var slider = document.getElementById("rangePortions");
var output = document.getElementById("huidigeWaarde");
output.innerHTML = slider.value;

slider.oninput = function (){
    output.innerHTML = this.value;
}


btnNext.onclick = function() {
    var container1 = document.getElementById("container1");
    var container2 = document.getElementById("container2");
    var container3 = document.getElementById("container3");
    var categories = document.getElementById("catgories");

    var recipeName = document.getElementById("recipeName").value;
    var imgMade = document.getElementById("imgSelfMade").checked;
    var description = document.getElementById("txtDescription").value;
    var portions = document.getElementById("rangePortions").value;
    var link = "";
    var categorie = categories.options[categories.selectedIndex].value;


    if(document.getElementById("recipeLink")){
        var link = document.getElementById("recipeLink").value;
    }

    if(container1.style.display == ""){
        var tags = []

        if(recipeName != "" & categorie != ""){
            var tagcontainer = document.getElementById("tagContainer");

            for (var i = 0; i < tagcontainer.childNodes.length; i++) {
                if (tagcontainer.childNodes[i].classList.contains("bg-primary")) {
                    note = tagcontainer.childNodes[i].innerText;
                    tags.push(note);
                }        
            }

            profilesave().then(response => {
                response.push(imgMade)
                var data = {
                "recipeId": <?php if($urlpaths[3]){echo $urlpaths[3];} else{echo 0;}; ?>,
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
                "link": link
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

            BtnPrev.style.display = 'flex';
            container1.style.display = 'none';
            container2.style.display = '';
            container3.style.display = 'none';
            const pageTitle = document.querySelector(".page-title");
            pageTitle.innerText = 'add ingredients';
        }else {
            window.alert("please add a recipe name and a category before continuing");
        }
    }else if(container2.style.display == ''){

        var data = {
            "recipeId": recipeId
        }

        fetch("/request/getIngredient.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
            ingredientsContainer.innerHTML = "";
            result.forEach(async function(rating) {
                ingredientsContainer.innerHTML += rating;
            })
        });

        BtnNext.style.display = 'none';
        container1.style.display = 'none';
        container2.style.display = 'none'
        container3.style.display = '';
        const pageTitle = document.querySelector(".page-title");
        pageTitle.innerText = 'add preparation';
    }
}

BtnPrev.onclick = function() {
    var container1 = document.getElementById("container1");
    var container2 = document.getElementById("container2");
    var container3 = document.getElementById("container3");

    var recipeName = document.getElementById("recipeName").value;
    var imgMade = document.getElementById("imgSelfMade").checked;
    var description = document.getElementById("txtDescription").value;
    var portions = document.getElementById("rangePortions").value;
    var categories = document.getElementById("catgories");
    var categorie = categories.options[categories.selectedIndex].value

    if(container2.style.display == ""){
        var data = {
            "recipeId": recipeId
        }

        fetch("/request/getIngredient.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
            ingredientsContainer.innerHTML = "";
            result.forEach(async function(rating) {
                ingredientsContainer.innerHTML += rating;
            })
        });

        BtnPrev.style.display = 'none';
        container1.style.display = '';
        container2.style.display = 'none'
        container3.style.display = 'none';
        const pageTitle = document.querySelector(".page-title");
        pageTitle.innerText = 'add recipe';
    }else if(container3.style.display == ''){
        BtnNext.style.display = 'flex';
        container1.style.display = 'none';
        container2.style.display = ''
        container3.style.display = 'none';
        const pageTitle = document.querySelector(".page-title");
        pageTitle.innerText = 'add ingredients';
    }
}

function addIngredientStep(name, element){
    document.getElementById("methodText").value += " "+name+ " ";

    document.getElementById("methodText").focus();
}

const deleteBtn = document.querySelector('#icon-trashCan');
document.getElementById("cancelIngredient").onclick = function() {klikajCancel()};

deleteBtn.onclick = function(){
            var data = {
                "recipeId" : <?= $urlpaths[3]?>
            };
            fetch("/request/deleteRecipe.php", {
                method: 'POST',
                body: JSON.stringify(data),
            }).then(response => response.json())
            .then(result => {
                window.location.replace("/home");
            });
        }
        function klikajEditrecipe(amountunit, unit, ingredient, id, element){
            document.getElementById("ingredientAmount").value = amountunit
            document.getElementById("ingredientUntit").value = unit
            document.getElementById("ingredientDesc").value = ingredient

            document.getElementById("addIngredient").innerHTML = "Update ingredient";
            document.getElementById("cancelIngredient").classList.remove("d-none");;

            document.getElementById("addIngredient").dataset.id = id;
        }
        function klikajCancel(){
            document.getElementById("ingredientAmount").value = "";
            document.getElementById("ingredientUntit").value = "";
            document.getElementById("ingredientDesc").value = "";

            document.getElementById("addIngredient").innerHTML = "Add ingredient";
            document.getElementById("cancelIngredient").classList.add("d-none");;

            document.getElementById("addIngredient").dataset.id = 0;
        }
        function klikajDelrecipe(i, container){
            const ids = i.split("_");
            id = ids[1];
            data = {
              "postID": id,
              recipeid: <?=$urlpaths[3]?>
            }
            var opts = {
              method: 'POST',
              body: JSON.stringify(data),
              headers: {
                'content-type': 'application/json'
              },
            };
             fetch('/request/deleteingredientrecipe.php', opts).then(response => response.json())
             .then(data =>{
               if(data == ""){
                document.getElementById(container).innerHTML = "No current items in shopping list";
                
               }else {
                document.getElementById(container).innerHTML = data;
               }
             }
               );
        }
const shareButton = document.querySelector('.share-button');

shareButton.addEventListener('click', event => {
  if (navigator.share) { 
   navigator.share({
      title: 'Recipe',
      url: '<?php  echo "http://" . $_SERVER['SERVER_NAME'] .'/recipe/'.$urlpaths[3]?>'
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(console.error);
    } else {
        alert("Coudnt share, try again later")
    }
});
</script>

<script src="/assets/js/recipe-edit.js"></script>
</body>
</html>
const sectionContainer = document.querySelector(".homepage-container");
const overviewButton = document.querySelector("#BtnOverview");
const ingredientsButton = document.querySelector("#BtnIngredients");
const methodButton = document.querySelector("#BtnMethod");
const iconBackArrow = document.querySelector("#icon-back-arrow");
const iconSearch = document.querySelector("#icon-search");
const iconBulletList = document.querySelector("#icon-bullet-list");
const iconFilter = document.querySelector("#icon-filter");

let pages = 3;
let page1Width = (sectionContainer.scrollWidth / 6);
let page2Width = (sectionContainer.scrollWidth /  6) * 3;
let page3Width = (sectionContainer.scrollWidth / 6) * 5;

let page1Scroll = 10;
let page2Scroll = (sectionContainer.scrollWidth / 3) + 10;
let page3Scroll = ((sectionContainer.scrollWidth / 3) * 2) + 10;

sectionContainer.addEventListener("scroll", () => {
    if(sectionContainer.scrollLeft > 0 && sectionContainer.scrollLeft < page1Width){
        overviewButton.classList.add("list-main-active");

        if(ingredientsButton.classList.contains("list-main-active")){
            ingredientsButton.classList.remove("list-main-active");
        }
        if(methodButton.classList.contains("list-main-active")){
            methodButton.classList.remove("list-main-active");
        }
    }
    if(sectionContainer.scrollLeft >= page1Width && sectionContainer.scrollLeft < page2Width){
        ingredientsButton.classList.add("list-main-active");

        if(overviewButton.classList.contains("list-main-active")){
            overviewButton.classList.remove("list-main-active");
        }
        if(methodButton.classList.contains("list-main-active")){
            methodButton.classList.remove("list-main-active");
        }
    }
    if(sectionContainer.scrollLeft >= page2Width && sectionContainer.scrollLeft < page3Width){
        methodButton.classList.add("list-main-active");

        if(overviewButton.classList.contains("list-main-active")){
            overviewButton.classList.remove("list-main-active");
        }
        if(ingredientsButton.classList.contains("list-main-active")){
            ingredientsButton.classList.remove("list-main-active");
        }
    }
});

overviewButton.addEventListener("click", ()=>{
    sectionContainer.scrollLeft = page1Scroll;
});

ingredientsButton.addEventListener("click", ()=>{
    sectionContainer.scrollLeft = page2Scroll;
});
methodButton.addEventListener("click", ()=>{
    sectionContainer.scrollLeft = page3Scroll;
});

function postcommentinput(id, comment) {
    if (event.key === "Enter") {
        postcomment(id, comment)
    }
}

function postcomment(id, comment) {
    var data = {
        "id": id,
        "comment": comment.value
    };

    var opts = {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "content-type": "application/json"
        },
    };
    fetch("/request/createcomment.php", opts).then(function (response) {
        comment.value = "";
        location.reload();
    })
}


document.getElementById("btnMinrecipeCount").addEventListener("click", convertrecipeRemove);
document.getElementById("btnAddrecipeCount").addEventListener("click", convertrecipeadd);
document.getElementById("BtnConvert").addEventListener("click", recipeConvert);
document.getElementById("BtnSaveList").addEventListener("click", saverecipeingredients);

function recipeConvert() {
    const amount = document.getElementById("convertAmount").innerText
    const converted_ele = document.getElementsByClassName("converted");

    for (var i = 0; i < converted_ele.length; ++i) {
        var item = converted_ele[i];  
        item.innerText = Math.round((item.dataset.amountunit / item.dataset.multiplier)* (amount)* 100) / 100
    }
}

function convertrecipeadd(){
    var number = parseInt(document.getElementById("convertAmount").innerText) + 1

    document.getElementById("convertAmount").innerText = number;
}

function convertrecipeRemove(){
    var number = parseInt(document.getElementById("convertAmount").innerText) - 1

    if(number < 1){
        document.getElementById("convertAmount").innerText = 1;    
    }else {
        document.getElementById("convertAmount").innerText = number;
    }
}

function saverecipeingredients(){
    const converted_check = document.getElementsByClassName("custom-checkbox");
    const converted_ele = document.getElementsByClassName("converted-container");
    customArr = [];

    for (var i = 0; i < converted_check.length; ++i) {
        if( converted_check[i].querySelector('.checkbox').checked === true) {
            var id = converted_ele[i].querySelector('.converted-ingredient').dataset.id;  
            var unit = converted_ele[i].querySelector('.converted-unit').innerHTML;  
            var amountunit = converted_ele[i].querySelector('.converted-amountunit').innerHTML;  
            arr = [id, unit, amountunit]

            customArr.push(arr);
        }
    }
    var data = {
        "ingredients": customArr,
        "amount": 1,
        "id":0
    };

    var opts = {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "content-type": "application/json"
        },
    };
    fetch("/request/addShoppingList.php", opts).then(function (response) {
        for (var i = 0; i < converted_check.length; ++i) {
            converted_check[i].querySelector('.checkbox').checked = false;
        }
        document.getElementById("myPopup").classList.toggle("show");
        setTimeout(function() {
            document.getElementById("myPopup").classList.toggle("show");
        }, 4900);
    })
}

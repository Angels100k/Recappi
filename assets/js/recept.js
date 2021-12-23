const sectionContainer = document.querySelector(".homepage-container");

const overviewButton = document.querySelector("#BtnOverview");
const ingredientsButton = document.querySelector("#BtnIngredients");
const methodButton = document.querySelector("#BtnMethod");
let pages = 3;
let page1Width = (sectionContainer.scrollWidth / 6);
let page2Width = (sectionContainer.scrollWidth /  6) * 3;
let page3Width = (sectionContainer.scrollWidth / 6) * 5;

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
    sectionContainer.scrollLeft = 0;
    console.log(page1Width)
});

ingredientsButton.addEventListener("click", ()=>{
    sectionContainer.scrollLeft = page2Width;
    console.log(page2Width)
});
methodButton.addEventListener("click", ()=>{
    sectionContainer.scrollLeft = page3Width;
    console.log(page3Width)
});

function postcommentinput(id, comment) {
    if (event.key === 'Enter') {
        postcomment(id, comment)
    }
}

function postcomment(id, comment) {
    var data = {
        "id": id,
        "comment": comment.value
    };

    var opts = {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'content-type': 'application/json'
        },
    };
    fetch('/request/createcomment.php', opts).then(function (response) {
        comment.value = "";
        location.reload();
    })
}


document.getElementById("btnMinrecipe").addEventListener("click", convertrecipeRemove);
document.getElementById("btnAddrecipe").addEventListener("click", convertrecipeadd);
document.getElementById("BtnConvert").addEventListener("click", recipeConvert);
document.getElementById("BtnSaveList").addEventListener("click", saverecipeingredients);

function recipeConvert() {
    const amount = document.getElementById("convertAmount").innerText
    const converted_ele = document.getElementsByClassName('converted');

    for (var i = 0; i < converted_ele.length; ++i) {
        var item = converted_ele[i];  

        item.innerText = parseInt(item.dataset.amountunit) * parseInt(amount)
        item.dataset.multiplier = amount;
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
    const converted_ele = document.getElementsByClassName('converted-container').childNodes;

    for (var i = 0; i < converted_ele.length; ++i) {
        var item = converted_ele[i];  

        console.log(item)
    }
}
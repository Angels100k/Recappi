const sectionContainer = document.querySelector(".homepage-container");

const btnaddRecipe = document.querySelector("#BtnAddRecipe");
const btnCancelRecipe = document.querySelector("#btnCancelRecipe");
const addRecipe = document.querySelector("#addRecipe");

const friendsButton = document.querySelector("#Btnfriends");
const discoverButton = document.querySelector("#BtnDiscover");

let page1Width = (sectionContainer.scrollWidth / 4);
let page2Width = (sectionContainer.scrollWidth / 4) * 3;

sectionContainer.addEventListener("scroll", () => {
    if(sectionContainer.scrollLeft > 0 && sectionContainer.scrollLeft < page1Width){
        friendsButton.classList.add("list-main-active");
        // discoverButton.classList.toggle("list-main-active")

        if(discoverButton.classList.contains("list-main-active")){
            discoverButton.classList.remove("list-main-active");
        }
    }
    if(sectionContainer.scrollLeft >= page1Width && sectionContainer.scrollLeft < page2Width){
        discoverButton.classList.add("list-main-active");

        // friendsButton.classList.toggle("list-main-active")
        if(friendsButton.classList.contains("list-main-active")){
            friendsButton.classList.remove("list-main-active");
        }
    }
});

friendsButton.addEventListener("click", ()=>{
    sectionContainer.scrollLeft = page1Width;
});

discoverButton.addEventListener("click", ()=>{
    sectionContainer.scrollLeft = page2Width;
});

btnaddRecipe.onclick = function (){
    toggleAddRecipe()
};
btnCancelRecipe.onclick = function (){
    toggleAddRecipe()
};
function toggleAddRecipe(){
    if(addRecipe.classList.contains('addRecipe-show')){
        addRecipe.classList.add("addRecipe-remove");
        addRecipe.classList.remove("addRecipe-show");
    }else {
    
        addRecipe.classList.remove("addRecipe-remove");
        addRecipe.classList.add("addRecipe-show");
    }
}
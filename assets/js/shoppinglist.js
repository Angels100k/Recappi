const addIngredient = document.getElementById("addIngredient");
const cancelIngredient = document.getElementById("cancelIngredient");
const shoppingListContainer = document.getElementById("shoppingListContainer");
const ingredientAmount = document.getElementById("ingredientAmount");
const ingredientVolume = document.getElementById("ingredientVolume");
const ingredientUntit = document.getElementById("ingredientUntit");
const ingredientDesc = document.getElementById("ingredientDesc");
const ingredientsOptions = document.getElementById("ingredients");
const searchIcon = document.getElementById("icon-search");
const backArrow = document.getElementById("icon-back-arrow");
const profileIcon = document.getElementById("icon-profile");

searchIcon.style.display = "none";
profileIcon.style.display = "none";
backArrow.style.display = "block";

    cancelIngredient.onclick = function() {klikajCancel()};

addIngredient.onclick = function() {
    let data = {
        "ingredientAmount" : ingredientAmount.value,
        "ingredientVolume" : ingredientVolume.value,
        "ingredientUntit"  : ingredientUntit.value,
        "ingredientDesc"  : ingredientDesc.value,
        "id": addIngredient.dataset.id,
        "recipeId" : null
    }
    if(ingredientAmount.value !== "" && ingredientDesc.value !== ""){
        fetch("/request/addIngredientShoppinglist.php", {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(response => response.json())
        .then(result => {
            // var array = JSON.parse(result);
            shoppingListContainer.innerHTML = "";
            result[0].forEach(async function(rating) {
                shoppingListContainer.innerHTML += rating;
            })
            ingredientsOptions.innerHTML = "";
            result[1].forEach(async function(rating) {
                ingredientsOptions.innerHTML += rating;
            })
            ingredientAmount.value = "";
            ingredientUntit.value = "";
            ingredientDesc.value = "";
            ingredientVolume.value = "";
            document.getElementById("addIngredient").innerHTML = "Add ingredient";
            document.getElementById("addIngredient").dataset.id = 0;
            document.getElementById("cancelIngredient").classList.add("d-none");
        });
    }
}
    
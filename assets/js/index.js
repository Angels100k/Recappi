var catitembutton;

window.onload = () => {
  'use strict';

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('/assets/js/sw.js');
  }
}

function likepost(id, item){
  data = {
    "postID": id,
  }
  var opts = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'content-type': 'application/json'
    },
  };
   fetch('/request/updatelike.php', opts).then(response => response.json())
   .then(data =>{
     if(data.OUT_result === 1){
      item.children[0].src = "/assets/img/svg/heartfill.svg";
    }else {
      item.children[0].src = "/assets/img/svg/heartempty.svg";
    }
        item.children[1].innerHTML = data.likes;
   }
     );
}

function savecategory(id,catid){
  
  data = {
      "postID": id,
      "catID": catid,
    }
    var opts = {
      method: 'POST',
      body: JSON.stringify(data),
      headers: {
        'content-type': 'application/json'
      },
    };
    fetch('/request/updatesave.php', opts).then(response => response.json())
    .then(data =>{
      
      if(data.OUT_result === 1){
        catitembutton.children[1].src = "/assets/img/svg/savefill.svg";
        document.getElementById('modalCategory').remove();
    }else {
        catitembutton.children[1].src = "/assets/img/svg/saveempty.svg";
      }
    }
      );
}

function savepost(id,item){
  catitembutton = item;
    
  if(item.children[1].src.indexOf("savefill") >= 0){
    
    savecategory(id,1)
  }else {
    

    var opts = {
      method: 'POST',
      headers: {
        'content-type': 'application/json'
      },
    };
    fetch('/request/getCategory.php', opts).then(response => response.json())
     .then(data =>{  
      var categories = "";
  
      data.forEach(async function(innerdata) {
        categories += `
        <button onclick="savecategory(`+id+`,`+innerdata["id"]+`)" class="button-no-style txt-black shadow col-12 bg-white p-1 border-small bs-bb mt-05">
          <div>
              <span class="text-semibold">`+ innerdata["name"] +`</span>
          </div>
        </button>
        `
      })
      document.getElementsByTagName("BODY")[0].innerHTML += 
      `    <div id="modalCategory" style="display:block;" class="modal">
      <div class="modal-content">
        <span class="close" onclick="document.getElementById('modalCategory').remove();">&times;</span>
        <p class="text-bold">Select catogory to save recipe</p>
        <div class="row">
        `+
        categories
        +`
        </div>
        <p class="text-bold" id="deleteTitle"></p>
        <div>
            <button id="closeModal" onclick="document.getElementById('modalCategory').remove();" class="timer rf" >cancel</button>
        </div>
      </div>
      </div>`;
     })  
  }
}

function imgerror(item, url){
  if(url !== "/assets/img/."){
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', url, false);
    xhr.send();
     
    if (xhr.status === "404") {
        item.src = "/assets/img/placeholder.png";
    } else {
        item.src = url;
    }
    console.log("error")
  }else{
    item.src = "/assets/img/placeholder.png";
  }
  
}

function invitefollower(id, item){
    data = {
        "followid": id,
    }
    var opts = {
        method: 'POST',
        body: JSON.stringify(data),
        headers:{
            'content-type': 'application/json'
        },
    };
    fetch('/request/updatefollow.php', opts).then(response => response.json())
        .then(data =>{
            if(data.OUT_result === 1){
                item.children[0].src = "/assets/img/svg/user-minus-solid.svg";
            }else{
                item.children[0].src = "/assets/img/svg/user-plus-solid.svg";
            }
        })
}

function klikaj(i) {
  const ids = i.split("_");
  y = document.getElementById(i);
  id = ids[1];
  data = {
    "postID": id,
  }
  var opts = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'content-type': 'application/json'
    },
  };
   fetch('/request/updategrocerys.php', opts).then(response => response.json())
   .then(data =>{
     if(data.OUT_result === 1){
      y.checked = true;
    }else {
      y.checked = false;
    }
   }
     );
}

function klikadd(i) {
  const ids = i.split("_");
  y = document.getElementById(i);
  id = ids[1];
     if(y.checked == false){
      y.checked = true;
    }else {
      y.checked = false;
    }
    
}


function klikajEdit(id, amount, ingredient, amountunit, unit, container) {
  document.getElementById("ingredientAmount").value = amount;
  document.getElementById("ingredientDesc").value = ingredient;
  document.getElementById("ingredientVolume").value = amountunit;
  document.getElementById("ingredientUntit").value = unit;

  document.getElementById("addIngredient").innerHTML = "Update ingredient";
  document.getElementById("cancelIngredient").classList.remove("d-none");

  document.getElementById("addIngredient").dataset.id = id;

}

function klikajCancel(){
  document.getElementById("ingredientAmount").value = ""
  document.getElementById("ingredientDesc").value = ""
  document.getElementById("ingredientVolume").value = ""
  document.getElementById("ingredientUntit").value = ""

  document.getElementById("addIngredient").innerHTML = "Add ingredient";
  document.getElementById("cancelIngredient").classList.add("d-none");

  document.getElementById("addIngredient").dataset.id = 0;
}

function klikajDel(i, container) {
  const ids = i.split("_");
  id = ids[1];
  data = {
    "postID": id,
  }
  var opts = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'content-type': 'application/json'
    },
  };
   fetch('/request/deletegrocerys.php', opts).then(response => response.json())
   .then(data =>{
     if(data === ""){
      document.getElementById(container).innerHTML = "No current items in shopping list";

     }else {
      document.getElementById(container).innerHTML = data;
     }
   }
     );
}



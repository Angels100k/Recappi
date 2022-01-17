window.onload = () => {
  'use strict';

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('/sw.js');
  }
}


function test(img, type) {
  console.log("img not found:" + img + type);
  data = {
    "img": img,
    "type": type
  }
  var opts = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'content-type': 'application/json'
    },
  };
  fetch('/createimg.php', opts).then(function (response) {
    console.log(response.json());
  })
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
     if(data.OUT_result == 1){
      item.children[0].src = "/assets/img/svg/heartfill.svg";
    }else {
      item.children[0].src = "/assets/img/svg/heartempty.svg";
    }
        item.children[1].innerHTML = data.OUT_Count;
   }
     );
}

function savepost(id,item){
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
   fetch('/request/updatesave.php', opts).then(response => response.json())
   .then(data =>{
     if(data.OUT_result == 1){
      item.children[1].src = "/assets/img/svg/savefill.svg";
    }else {
      item.children[1].src = "/assets/img/svg/saveempty.svg";
    }
   }
     );
}

function imgerror(item, url){
  var xhr = new XMLHttpRequest();
  xhr.open('HEAD', url, false);
  xhr.send();
   
  if (xhr.status == "404") {
      item.src = "/assets/img/placeholder.png";
  } else {
      item.src = url;
  }
  console.log("error")
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
          console.log(data);
            if(data.OUT_result == 1){
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
     if(data.OUT_result == 1){
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
  document.getElementById("ingredientAmount").value = amount
  document.getElementById("ingredientDesc").value = ingredient
  document.getElementById("ingredientVolume").value = amountunit
  document.getElementById("ingredientUntit").value = unit

  document.getElementById("addIngredient").innerHTML = "Update ingredient";
  document.getElementById("cancelIngredient").classList.remove("d-none");;

  document.getElementById("addIngredient").dataset.id = id;

console.log(container);
}

function klikajCancel(){
  document.getElementById("ingredientAmount").value = ""
  document.getElementById("ingredientDesc").value = ""
  document.getElementById("ingredientVolume").value = ""
  document.getElementById("ingredientUntit").value = ""

  document.getElementById("addIngredient").innerHTML = "Add ingredient";
  document.getElementById("cancelIngredient").classList.add("d-none");;

  document.getElementById("addIngredient").dataset.id = 0;
}

function klikajDel(i, container) {
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
   fetch('/request/deletegrocerys.php', opts).then(response => response.json())
   .then(data =>{
    document.getElementById(container).innerHTML = data;
    console.log(data);
   }
     );
  console.log(id)
}



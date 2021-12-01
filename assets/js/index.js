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

//Selects all .closeData elements
var parents = document.querySelectorAll('.receptitem');

//For each .closeData, find the first div and stops the propagation
// for(var i = 0; i < parents.length; i++) {
//     var child = parents[i].querySelector('button');
//     child.addEventListener('click', function(pEvent) {
//         pEvent.stopPropagation();
//         console.log("clicked");
//     })
// }
function likepost(id, text, item){
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
  //.then(function (response) {
  //   json = response.json();
  //   console.log(json)
  //   // if(json.OUT_result == 1){
  //   //   item.children[0].src = "/assets/img/svg/heartfill.svg"
  //   // }else {
  //   //   item.children[0].src = "/assets/img/svg/heartempty.svg"
  //   // }
  //   // item.children[1].innerHTML = json.OUT_Count;

  // }).then(data => {
  //   console.log('Success:', data);
  // })

}
function savepost(id, item){
  safepostcall(id);
  console.log(item.children[1].src);
  item.children[1].src = "/assets/img/svg/savefill.svg"
}

function safepostcall(id) {
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
  fetch('/request/updatesave.php', opts).then(function (response) {
    json = response.json;
    if(json.OUT_result == 0){

    }

  })
}
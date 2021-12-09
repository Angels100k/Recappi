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
    fetch('request/updatefollow.php', opts).then(response => response.json())
        .then(data =>{
            if(data.OUT_result == 1){
                item.children[1].src = "/assets/img/svg/followmin.svg";
            }else{
                item.children[1].src = "/assets/img/svg/followplus"
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
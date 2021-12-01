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
  console.log(item.children[0].src);
  console.log(item.children[1].innerHTML);
  item.children[0].src = "/assets/img/svg/heartfill.svg"
  item.children[1].innerHTML = parseInt(item.children[1].innerHTML) + 1;
}
function savepost(id, item){
  loadDoc(id);
  console.log(item.children[1].src);
  item.children[1].src = "/assets/img/svg/savefill.svg"
}

function loadDoc(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =
      this.responseText;
    }
  };
  xhttp.setRequestHeader("postID", id)
  xhttp.open("GET", "request/updatelike.php");
  xhttp.send();
}
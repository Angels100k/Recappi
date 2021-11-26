window.onload = () => {
  'use strict';

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('./sw.js');
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

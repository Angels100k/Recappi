var files = document.getElementById('recipepic');
var image = document.getElementById("recipeimage");
var currentimagefile;

files.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
  const curFiles = files.files;

    for(const file of curFiles) {
      if(validFileType(file)) {
        currentimagefile = file;
        image.src = URL.createObjectURL(file);
      }
    }
}

const fileTypes = [
  "image/apng",
  "image/bmp",
  "image/jpeg",
  "image/pjpeg",
  "image/png",
  "image/svg+xml",
  "image/webp",
];

function validFileType(file) {
  return fileTypes.includes(file.type);
}

async function profilesave(){
  var imagearray = [];

    if(currentimagefile == null){
        imagearray.push(image.dataset.name, image.dataset.type);
            return imagearray;
    }else {
      var result = await new Promise((resolve, reject) => {
        const formData = new FormData()
        formData.append('files[]', currentimagefile)
        fetch("/request/uploadimg.php", {
            method: 'POST',
            body: formData,
          })
          .then(response => (response.json()))
          .then(result => {
            const tempimagearray = result.split(".");
            tempimagearray.forEach(element => imagearray.push(element));
            resolve(imagearray);
        });
      });
      return result;
       
    }
    
}

function linecontinue(){
    imagearray.push(username.value, email.value, bio.value);
    fetch("/request/updateprofile.php", {
        method: 'POST',
        body: JSON.stringify(imagearray),
      }).then(response => response.json())
      .then(result => {
        location.replace("/home")
    });
}
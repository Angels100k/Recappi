var files = document.getElementById('profilepic');
var image = document.getElementById("profileimage");
var username = document.getElementById("username");
var email = document.getElementById("email");
var bio = document.getElementById("bio");
var currentimagefile;
imagearray = [];

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

function profilesave(){

    if(currentimagefile == null){
        imagearray.push(image.dataset.name, image.dataset.type);
        linecontinue();
    }else {
        const formData = new FormData()
        formData.append('files[]', currentimagefile)
        fetch("/request/uploadimg.php", {
            method: 'POST',
            body: formData,
          })
          .then(response => response.json())
          .then(result => {
            const tempimagearray = result.split(".");
            tempimagearray.forEach(element => imagearray.push(element));
            linecontinue();
        });
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
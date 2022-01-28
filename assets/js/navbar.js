const searchmenu = document.querySelector("#search-menu");
const searchResultRecipe = document.querySelector("#searchResultRecipe");
const searchResultPeople = document.querySelector("#searchResultPeople");
const searchbar = document.querySelector("#searchbar");

function openSettings() {
  // const pageTitle = document.querySelector('#page-title');
  // const iconSettings = document.querySelector('#icon-settings');
  // const iconNotifications = document.querySelector('#icon-notifications');
  // const iconProfile = document.querySelector('#icon-profile');
  // const settingsMenu = document.querySelector('#settings-menu');
  // const backArrow = document.querySelector('#icon-back-arrow');
  // const searchBox = document.querySelector('#icon-search');
  // const iconBackArrow = document.querySelector('#icon-back-arrow');
  // const iconBackArrow2 = document.querySelector('#icon-back-arrow-2');

  // settingsMenu.style.display = 'block';
  // iconSettings.style.display = 'none';
  // iconNotifications.style.display = "none";
  // iconProfile.style.display = 'none';
  // searchBox.style.display = 'none';
  // backArrow.style.display = 'block';
  // pageTitle.innerText = 'Settings';
  // iconBackArrow.style.display = 'none';
  // iconBackArrow2.style.display = 'block';
  location.href = "/settings"
}
function closeSettings(){
  const pageTitle = document.querySelector('#page-title');
  const iconSettings = document.querySelector('#icon-settings');
  const iconNotifications = document.querySelector('#icon-notifications');
  const iconProfile = document.querySelector('#icon-profile');
  const settingsMenu = document.querySelector('#settings-menu');
  const backArrow = document.querySelector('#icon-back-arrow');
  const searchBox = document.querySelector('#icon-search');

  settingsMenu.style.display = 'none';

  iconSettings.style.display = 'block';
  iconNotifications.style.display = "block";
  iconProfile.style.display = 'block';
  searchBox.style.display = 'block';
  backArrow.style.display = 'none';
  pageTitle.innerText = 'Settings';
}
function openNotifications() {
  const pageTitle = document.querySelector('#page-title');
  const iconBackArrow = document.querySelector('#icon-back-arrow');
  const iconBackArrow2 = document.querySelector('#icon-back-arrow-2');
  const iconSearch = document.querySelector('#icon-search');
  const iconSettings = document.querySelector('#icon-settings');

  iconBackArrow.style.display = 'block';
  iconSearch.style.display = 'none';
  iconSettings.style.display = 'none';
  pageTitle.innerText = 'Notifications';
  iconBackArrow.style.display = 'none';
  iconBackArrow2.style.display = 'block';
}

function searchOpen(){
  const searchBtn = document.querySelector(".search-btn");
  const searchBox = document.querySelector(".search-box");
  const searchBoxInput = document.querySelector(".search-box input");

  searchBox.classList.add("active");
  searchBtn.style.display = 'none';
  searchBoxInput.style.display = 'block';
}

function searchClose(){
  const searchBtn = document.querySelector(".search-btn");
  const searchBox = document.querySelector(".search-box");
  const searchBoxInput = document.querySelector(".search-box input");

  searchBox.classList.remove("active");
  searchBtn.style.display = 'block';
  searchBoxInput.style.display = 'none';
}

function homeArrow(){
  
}

function userProfile() {
  const pageTitle = document.querySelector('#page-title');

  pageTitle.innerText = 'Profile';
}

if(searchbar){
  searchbar.addEventListener("keyup", () => {
    if (searchbar.value === "") {
      searchmenu.style.display = "none";
    } else {
      searchmenu.style.display = "block";
      search(searchbar.value)
    }
  });
}

function search(value) {
  data = {
    "item": value,
    "limit": 5
  }
  let opts = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'content-type': 'application/json'
    },
  };
  fetch('/request/getsearch.php', opts).then(response => response.json())
    .then(data => {
      searchResultRecipe.innerHTML = data;
    });
  fetch('/request/getsearchpeople.php', opts).then(response => response.json())
    .then(data => {
      searchResultPeople.innerHTML = data;
    });
}
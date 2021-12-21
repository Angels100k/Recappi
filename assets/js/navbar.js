function openSettings() {
  const pageTitle = document.querySelector('#page-title');
  const iconSettings = document.querySelector('#icon-settings');
  const iconNotifications = document.querySelector('#icon-notifications');
  const iconProfile = document.querySelector('#icon-profile');
  const settingsMenu = document.querySelector('#settings-menu');

  iconSettings.style.display = "none";
  iconNotifications.style.display = "none";
  iconProfile.style.display = "none";
  pageTitle.innerText = "Settings";
  settingsMenu.style.display = "block";
}

function openNotifications() {
  const pageTitle = document.querySelector('#page-title');
  const iconBackArrow = document.querySelector('#icon-back-arrow');
  const iconSearch = document.querySelector('#icon-search');
  const iconFilter = document.querySelector('#icon-filter');
  const iconSettings = document.querySelector('#icon-settings');

  iconBackArrow.style.display = "block";
  iconSearch.style.display = "none";
  iconFilter.style.display = "none";
  iconSettings.style.display = "block";
  pageTitle.innerText = "Notifications";

  iconBackArrow.href = "/home/"
}

function userProfile() {
  const pageTitle = document.querySelector('#page-title');

  pageTitle.innerText = "Profile";
}
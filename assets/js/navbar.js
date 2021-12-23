function openSettings() {
  const pageTitle = document.querySelector('#page-title');
  const iconSettings = document.querySelector('#icon-settings');
  const iconNotifications = document.querySelector('#icon-notifications');
  const iconProfile = document.querySelector('#icon-profile');
  const settingsMenu = document.querySelector('#settings-menu');
  // const iconBackArrow = document.querySelector('#icon-back-arrow');

  settingsMenu.style.display = 'block';
  // iconBackArrow.removeAttribute('href');
  // iconBackArrow.addEventListener('click', () => {
  //   settingsMenu.classList.remove('open');
  // });
  // settingsMenu.classList.add('open');
  iconSettings.style.display = 'none';
  iconNotifications.style.display = "none";
  iconProfile.style.display = 'none';
  pageTitle.innerText = 'Settings';
}

function openNotifications() {
  const pageTitle = document.querySelector('#page-title');
  const iconBackArrow = document.querySelector('#icon-back-arrow');
  const iconSearch = document.querySelector('#icon-search');
  const iconFilter = document.querySelector('#icon-filter');
  const iconSettings = document.querySelector('#icon-settings');

  iconBackArrow.style.display = 'block';
  iconSearch.style.display = 'none';
  iconFilter.style.display = 'none';
  iconSettings.style.display = 'block';
  pageTitle.innerText = 'Notifications';

  iconBackArrow.href = '/home/'
}

function userProfile() {
  const pageTitle = document.querySelector('#page-title');

  pageTitle.innerText = 'Profile';
}
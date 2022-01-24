document.getElementById('icon-back-arrow').addEventListener('click', (e) => {
  e.preventDefault();
  window.history.back();
})

document.getElementById('icon-back-arrow-2').addEventListener('click', (e) => {
  e.preventDefault();
  window.location.reload();
})

console.log('hallo');
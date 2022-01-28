const iconBackArrow = document.getElementById('icon-back-arrow');
const iconBackArrow2 = document.getElementById('icon-back-arrow2');

if(iconBackArrow){
  iconBackArrow.addEventListener('click', (e) => {
    e.preventDefault();
    window.history.back();
  })  
}
if(iconBackArrow2){
  iconBackArrow2.addEventListener('click', (e) => {
    e.preventDefault();
    window.location.reload();
  })
}
let menuToggle = document.querySelector('.toggle');
let sidebar = document.querySelector('.h-navigation');
let logo = document.querySelector('.h-logo');
var main = document.getElementById("main-page");

menuToggle.onclick = function () {
  // Toggle menu and sidebar
  menuToggle.classList.toggle('h-active');
  sidebar.classList.toggle('h-active');
  
}


let listItems = document.querySelectorAll('.h-navigation ul li');

listItems.forEach((item, index) => {
  item.addEventListener('click', function () {
    // Toggle active class on navigation items
    listItems.forEach((li) => {
      li.classList.remove('h-active');
    });
    item.classList.add('h-active');
    moveLogo(index);
  });
});



function menuOnClick() {
  document.getElementById("menu-bar").classList.toggle("change");
  document.getElementById("nav").classList.toggle("change");
  document.getElementById("menu-bg").classList.toggle("change-bg");
}



// Récupérer les éléments
const menuBar = document.getElementById('menu-bar');
const nav = document.querySelector('.nav');
const menuBg = document.querySelector('.menu-bg');

function closeMenu() {
  // Retirer les classes qui affichent le menu
  menuBar.classList.remove('change');
  nav.style.display = 'none';
  menuBg.classList.remove('change-bg');
}

window.addEventListener('scroll', () => {
  // Si le menu est ouvert, on le ferme au scroll
  if (menuBar.classList.contains('change')) {
    closeMenu();
  }
});

// Fonction pour ouvrir/fermer le menu au clic (exemple)
function menuOnClick() {
  if (menuBar.classList.contains('change')) {
    closeMenu();
  } else {
    menuBar.classList.add('change');
    nav.style.display = 'block';
    menuBg.classList.add('change-bg');
  }
}

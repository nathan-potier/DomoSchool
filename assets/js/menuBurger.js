document.addEventListener('DOMContentLoaded', function() {
  const menuBar = document.getElementById('menu-bar');
  const nav = document.querySelector('.nav');
  const menuBg = document.querySelector('.menu-bg');
  const navItems = document.querySelectorAll('.nav li');

  function menuOnClick(event) {
    event.stopPropagation(); // Empêcher la propagation de l'événement de clic
    menuBar.classList.toggle('change');
    menuBg.classList.toggle('change-bg');
    nav.classList.toggle('change');
    if (nav.classList.contains('change')) {
    navItems.forEach((item, index) => {
        setTimeout(() => {
        item.classList.add('visible');
        }, index * 50); // 50ms entre chaque item
    });
    } else {
    navItems.forEach((item) => {
        item.classList.remove('visible');
    });
    }


  }

    function closeMenu() {
    menuBar.classList.remove('change');
    nav.classList.remove('change');
    menuBg.classList.remove('change-bg');
    navItems.forEach((item) => {
        item.classList.remove('visible'); // ← ici tu réinitialises aussi les <li>
    });
    }

    document.addEventListener('click', function(event) {
    const isClickInsideMenu = menu.contains(event.target);
    const isClickOnMenuBar = menuBar.contains(event.target);
    const isClickOnMenuBg = menuBg.contains(event.target);

    // Si on clique ni dans le menu, ni sur le bouton menu, ni sur le cercle rouge
    if (!isClickInsideMenu && !isClickOnMenuBar && !isClickOnMenuBg) {
        closeMenu();
    }
    });

  // Ajouter un écouteur d'événement de clic spécifique au bouton de menu
  menuBar.addEventListener('click', menuOnClick);

  window.addEventListener('scroll', function() {
    if (menuBar.classList.contains('change')) {
      closeMenu();
    }
  });

  
});

document.addEventListener("DOMContentLoaded", () => {
    const boutonBurger = document.querySelector('.boutonBurger');
    const menuBurger = document.querySelector('.menuBurger');
    const span1 = document.querySelector('.span1');
    const span2 = document.querySelector('.span2');
    const span3 = document.querySelector('.span3');
    const elts = document.querySelectorAll('.menuBurger a');
    const body = document.body;

    function toggleMenu() {
        menuBurger.classList.toggle('menuBurgerOpen');
        span1.classList.toggle('span1Open');
        span2.classList.toggle('span2Open');
        span3.classList.toggle('span3Open');
        body.classList.toggle('no-scroll'); // Bloque/débloque le scroll
    }

    boutonBurger.addEventListener('click', toggleMenu);
    elts.forEach(elt => elt.addEventListener('click', toggleMenu));
});

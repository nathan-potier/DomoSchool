let lastScrollTop = 0;
const header = document.querySelector('header');
const backToTopButton = document.querySelector('.back-to-top');
const containers = document.querySelectorAll('.container');
let lastHeaderHeight = 0; 
let lastWindowWidth = window.innerWidth; 


// Fonction pour ajuster les marges en fonction de la hauteur du header
function adjustMargins() {
    if (header && containers.length > 0) {
        const headerHeight = header.offsetHeight;

        if (headerHeight !== lastHeaderHeight || window.innerWidth !== lastWindowWidth) {
            containers.forEach(container => {
                container.style.marginTop = ''; // Réinitialiser
                const existingMarginTop = parseFloat(window.getComputedStyle(container).marginTop) || 0;
                container.style.marginTop = `${headerHeight + existingMarginTop}px`;
            });
            lastHeaderHeight = headerHeight;
            lastWindowWidth = window.innerWidth;
        }
    }
}



  

// Au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    header.style.transform = 'translateY(0)';
    header.classList.remove('hidden');
    
    setTimeout(() => {
        adjustMargins();
        document.body.classList.remove('hidden-content');
    }, 100);

    const sections = document.querySelectorAll('.container section');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    sections.forEach(section => observer.observe(section));
});

// Quand on redimensionne la fenêtre
window.addEventListener('resize', adjustMargins);

// Quand on scrolle
window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const headerHeight = header.offsetHeight;



    if (scrollTop > 50) {
        if (scrollTop > lastScrollTop) {
            // Scrolling down - cacher le header
            header.classList.add('hidden');
        } else if (scrollTop < lastScrollTop) {
            // Scrolling up - montrer le header et décaler la page
            if (header.classList.contains('hidden')) {
                header.classList.remove('hidden');
                
            }
        }
    } else {
        header.classList.remove('hidden');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;

    if (scrollTop > 300) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }
});

// Remonter en haut de la page
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}




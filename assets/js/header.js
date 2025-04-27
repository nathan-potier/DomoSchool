let lastScrollTop = 0;
const header = document.querySelector('header');
const backToTopButton = document.querySelector('.back-to-top');
const container = document.querySelector('.container');

document.addEventListener('DOMContentLoaded', function() {
  const sections = document.querySelectorAll('.container section');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, {
    threshold: 0.1
  });

  sections.forEach(section => {
    observer.observe(section);
  });

  // Ajuste la marge en haut en fonction de la visibilité du header
  if (header && container) {
    const headerHeight = header.offsetHeight;
    container.style.marginTop = headerHeight + 'px';
  }
});

window.addEventListener('scroll', function() {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  if (scrollTop > lastScrollTop) {
    // Scrolling down
    header.classList.add('hidden');
  } else {
    // Scrolling up
    header.classList.remove('hidden');
  }
  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling

  if (scrollTop > 300) {
    backToTopButton.classList.add('show');
  } else {
    backToTopButton.classList.remove('show');
  }
});

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

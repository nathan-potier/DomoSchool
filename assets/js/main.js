document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.querySelector('input[name="theme-mode"]');
    const btToggle = document.querySelector('.btToggle');


    function invertLogoColors(shouldInvert) {
        const logo = document.querySelector('.logo img');
        if (logo) {
            if (shouldInvert) {
                logo.style.filter = 'brightness(0) invert(1)';
                logo.style.backgroundColor = ''; // <-- couleur que tu veux
                logo.style.mixBlendMode = 'screen'; // ou multiply selon effet voulu
            } else {
                logo.style.filter = '';
                logo.style.backgroundColor = '';
                logo.style.mixBlendMode = '';
            }
        }
    }
    
   


    
    function applyMode(isDark) {
        document.documentElement.classList.remove('mode-dark', 'mode-white');
        document.documentElement.classList.add(isDark ? 'mode-dark' : 'mode-white');
        localStorage.setItem('mode', isDark ? 'mode-dark' : 'mode-white');
        toggle.checked = isDark;


        invertLogoColors(isDark);
        // Update iframes after theme change
        updateIframesTheme(isDark);
    }

    function initTheme() {
        const savedMode = localStorage.getItem('mode');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const initialMode = savedMode === 'mode-dark' || (!savedMode && systemPrefersDark);
        
        applyMode(initialMode);
    }

    toggle.addEventListener('change', function(e) {
        btToggle.classList.add('animated');
        applyMode(e.target.checked);
        setTimeout(() => {
            btToggle.classList.remove('animated');
        }, 400);
    });

    initTheme();

    function updateIframesTheme(isDark) {
        const iframes = document.querySelectorAll('iframe');
        
        iframes.forEach(iframe => {
            iframe.addEventListener('load', () => {
                try {
                    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
    
                    const style = iframeDoc.createElement('style');
                    style.textContent = isDark ? `
                    body {
                        background-color: #181818 !important;
                        color: #e0e0e0 !important;
                    }
                    pre[class*="language-"], code[class*="language-"] {
                        background: #2e2e2e !important;
                        color: #f5f5f5 !important;
                        text-shadow: none !important;
                    }
                ` : `
                    body {
                        background-color: #ffffff !important;
                        color: #333333 !important;
                    }
                    pre[class*="language-"], code[class*="language-"] {
                        background: #f5f5f5 !important;
                        color: #333333 !important;
                    }
                `;

    
                    iframeDoc.head.appendChild(style);
                } catch (e) {
                    console.warn('Impossible de modifier le contenu de l\'iframe (cross-origin).');
                }
            });
    
            // Recharge forcée de l'iframe pour appliquer le style si nécessaire
            if (iframe.src) {
                iframe.src = iframe.src;
            }
        });
    }
    
});


window.addEventListener('resize', function() {
    if (window.innerWidth <= 768) {
        // Appliquer des changements spécifiques pour les petits écrans
        document.querySelectorAll('pre[class*="language-"]').forEach(function(block) {
            block.style.fontSize = '12px';
        });
    } else {
        document.querySelectorAll('pre[class*="language-"]').forEach(function(block) {
            block.style.fontSize = '';
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.querySelector('input[name="theme-mode"]');
    const btToggle = document.querySelector('.btToggle');
    
    // Applique le mode sans animation
    function applyMode(isDark) {
        // D'abord, supprimer toutes les classes de mode
        document.documentElement.classList.remove('mode-dark', 'mode-white');
        
        // Ensuite, ajouter la classe appropriée
        document.documentElement.classList.add(isDark ? 'mode-dark' : 'mode-white');
        
        // Mettre à jour le stockage local
        localStorage.setItem('mode', isDark ? 'mode-dark' : 'mode-white');
        
        // Mettre à jour l'état du toggle
        toggle.checked = isDark;
    }

    // Initialisation
    function initTheme() {
        const savedMode = localStorage.getItem('mode');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const initialMode = savedMode === 'mode-dark' || (!savedMode && systemPrefersDark);
        
        // Appliquer le mode avant tout rendu
        applyMode(initialMode);
        
        

    }

    // Gestion du clic avec animation
    toggle.addEventListener('change', function(e) {
        // Activer les animations
        btToggle.classList.add('animated');
        
        applyMode(e.target.checked);
        
        // Désactiver les animations après la transition
        setTimeout(() => {
            btToggle.classList.remove('animated');
        }, 400);
    });

    initTheme();
});
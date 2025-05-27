

document.addEventListener("DOMContentLoaded", () => {
    const notif = document.getElementById("notification");

    // Supprimer la notif après 10 secondes
    if (notif) {
        setTimeout(() => {
            notif.style.opacity = "0";
            notif.style.transition = "opacity 0.5s ease";
            setTimeout(() => notif.remove(), 500); // la retirer du DOM après la transition
        }, 4000);
    }

    // Nettoyer l'URL (supprimer les paramètres ?success=... ou ?error=...)
    const url = new URL(window.location.href);
    if (url.searchParams.has("success") || url.searchParams.has("error")) {
        window.history.replaceState({}, document.title, url.pathname);
    }
});
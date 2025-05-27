let startTime = Date.now();

function resizeIframe(iframe) {
    iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("completion-form");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // bloque le rechargement

            const timeSpent = Math.max(Math.round((Date.now() - startTime) / 60000), 1);
            // Remplit l'input hidden
            document.getElementById("time_spent_input").value = timeSpent;

            const formData = new FormData(form);

            fetch(form.action || window.location.href, {
                method: "POST",
                body: formData,
                credentials: "same-origin"
            })
            .then(response => response.text())
            .then(data => {
                alert("Cours marqué comme lu !");
                // Ici tu peux modifier le DOM pour changer le bouton, afficher un message, etc.
            })
            .catch(() => alert("Erreur lors de la mise à jour du cours."));
        });
    }
});

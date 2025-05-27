let startTime = Date.now();

function resizeIframe(iframe) {
    iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("completion-form");
    if (form) {
        form.addEventListener("submit", function () {
            const timeSpent = Math.round((Date.now() - startTime) / 60000);
            document.getElementById("time_spent_input").value = Math.max(timeSpent, 1);
        });
    }
});



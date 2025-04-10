document.addEventListener("DOMContentLoaded", function() {
    console.log("DomiSchool est prêt !");
    
    // Example of form validation
    const loginForm = document.querySelector('form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                alert("Tous les champs doivent être remplis !");
                event.preventDefault();
            }
        });
    }
});

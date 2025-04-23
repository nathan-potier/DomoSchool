<?php include('../../includes/header.php'); ?>

<div class="container signup-container">
    <h1 class="signup-title">📝 Créer un compte</h1>
    <p class="signup-description">
        Rejoignez <strong>DomoSchool</strong> avec votre code d'accès unique.
    </p>
    
    <?php include('../../includes/notif.php'); ?>
    
    <form method="post" action="../../models/register_user.php" class="signup-form">
        <label for="access_code" class="signup-label">🔑 Code d'accès :</label>
        <input type="text" id="access_code" name="access_code" required placeholder="Entrez votre code unique" class="signup-input">
        
        <div id="user-fields" >
            <label for="first_name" class="signup-label">👤 Prénom :</label>
            <input type="text" id="first_name" name="first_name" required placeholder="Jean" class="signup-input">
            
            <label for="last_name" class="signup-label">👤 Nom :</label>
            <input type="text" id="last_name" name="last_name" required placeholder="Dupont" class="signup-input">
            
            <label for="email" class="signup-label">📧 Adresse email :</label>
            <input type="email" id="email" name="email" required placeholder="exemple@email.com" class="signup-input">
            
            <label for="password" class="signup-label">🔒 Mot de passe :</label>
            <input type="password" id="password" name="password" required placeholder="********" class="signup-input">
            
            <label for="password_confirm" class="signup-label">🔒 Confirmer le mot de passe :</label>
            <input type="password" id="password_confirm" name="password_confirm" required placeholder="********" class="signup-input">
            
            <input type="hidden" id="role" name="role">
            
            <button type="submit" class="signup-btn">S'inscrire</button>
        </div>
    </form>

    <p class="signup-login-link">
        Déjà un compte ? <a href="login.php" class="signup-login-link-text">Se connecter</a>
    </p>
    <p class="signup-login-link">
        Besoin d'un code ? <a href="../purchase/purchase_code.php" class="signup-login-link-text">Acheter un code d'accès</a>
    </p>
</div>

<script>
document.getElementById('access_code').addEventListener('change', function() {
    console.log('Code saisi:', this.value); // Debug 1
    
    fetch('../../models/check_code.php?code=' + encodeURIComponent(this.value))
        .then(response => {
            console.log('Réponse brute:', response); // Debug 2
            return response.json();
        })
        .then(data => {
            console.log('Données reçues:', data); // Debug 3
            if(data.valid) {
                document.getElementById('role').value = data.role;
                
            } else {
                alert('Code invalide : ' + (data.message || 'Code déjà utilisé ou inexistant'));
            }
        })
        .catch(error => {
            console.error('Erreur fetch:', error); // Debug 4
            alert('Erreur de communication avec le serveur');
        });
});
</script>

<?php include('../../includes/footer.php'); ?>
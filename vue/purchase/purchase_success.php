<?php include('../../includes/header.php'); ?>

<div class="container purchase-success">
    <h1 class="success-title">✅ Achat réussi !</h1>
    
    <?php if(isset($_SESSION['purchased_code'])): ?>
        <div class="success-code">
            <p>Votre code d'accès :</p>
            <div class="code-display" id="purchased-code"><?= htmlspecialchars($_SESSION['purchased_code']) ?></div>
            <button id="copy-button" class="copy-button">Copier le code</button>
            <p class="code-instructions">
                Utilisez ce code pour créer votre compte sur la page <a href="<?= BASE_URL ?>/register">d'inscription</a>.
            </p>
        </div>
        <script>
            // Stocker le code d'accès dans le localStorage
            localStorage.setItem('purchased_code', '<?= htmlspecialchars($_SESSION['purchased_code']) ?>');
            // Supprimer le code de session après stockage dans localStorage
            <?php unset($_SESSION['purchased_code']); ?>
        </script>
    <?php else: ?>
        <p>Aucun code trouvé. Veuillez vérifier votre email ou contacter le support.</p>
    <?php endif; ?>
</div>  

<?php include('../../includes/footer.php'); ?>



<script>

document.getElementById("copy-button").addEventListener("click", function() {
    const codeText = document.getElementById("purchased-code").textContent;
    navigator.clipboard.writeText(codeText).then(function() {
        alert("Code copié !");
    }, function(err) {
        alert("Erreur lors de la copie du code : " + err);
    });
});

</script>
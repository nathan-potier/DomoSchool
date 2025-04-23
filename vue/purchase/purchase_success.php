<?php include('../../includes/header.php'); ?>

<div class="container purchase-success">
    <h1 class="success-title">✅ Achat réussi !</h1>
    
    <?php if(isset($_SESSION['purchased_code'])): ?>
        <div class="success-code">
            <p>Votre code d'accès :</p>
            <div class="code-display"><?= htmlspecialchars($_SESSION['purchased_code']) ?></div>
            <p class="code-instructions">
                Utilisez ce code pour créer votre compte sur la page <a href="<?php echo BASE_URL; ?>/vue/auth/register.php">d'inscription</a>.
            </p>
        </div>
        <?php unset($_SESSION['purchased_code']); ?>
    <?php else: ?>
        <p>Aucun code trouvé. Veuillez vérifier votre email ou contacter le support.</p>
    <?php endif; ?>
</div>

<?php include('../../includes/footer.php'); ?>
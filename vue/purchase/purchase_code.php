<?php include('../../includes/header.php'); ?>

<div class="container purchase-container">
    <h1 class="purchase-title">🛒 Acheter un code d'accès</h1>
    
    <div class="purchase-options">
        <div class="purchase-option">
            <h3>Élève</h3>
            <p class="price">19,99€</p>
            <p>Accès complet aux cours et exercices</p>
            <a href="<?= BASE_URL ?>/checkout?role=student" class="purchase-btn">Acheter</a>
        </div>
        
        <div class="purchase-option">
            <h3>Parent</h3>
            <p class="price">9,99€</p>
            <p>Suivi des progrès de votre enfant</p>
            <a href="<?= BASE_URL ?>/checkout?role=parent" class="purchase-btn">Acheter</a>
        </div>
        
        <div class="purchase-option">
            <h3>Professeur</h3>
            <p class="price">Contactez-nous</p>
            <p>Pour créer des cours et exercices</p>
            <a href="<?= BASE_URL ?>/contact" class="purchase-btn">Nous contacter</a>
        </div>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();
?>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <h1>FAQ – Foire Aux Questions</h1>

    <section>
        <h2>1. Qu’est-ce que DomoSchool ?</h2>
        <p>DomoSchool est une plateforme d’apprentissage en ligne qui propose des cours particuliers en visioconférence, des exercices interactifs, et un suivi des progrès en temps réel pour les parents.</p>
    </section>

    <section>
        <h2>2. À qui s’adresse la plateforme ?</h2>
        <p>Aux élèves du primaire, collège et lycée, ainsi qu’à leurs parents et aux enseignants souhaitant proposer un accompagnement scolaire personnalisé.</p>
    </section>

    <section>
        <h2>3. Comment fonctionne l’accompagnement ?</h2>
        <p>Chaque élève bénéficie d’un espace de travail personnalisé avec des cours et exercices adaptés à son niveau. Il peut suivre des sessions en visioconférence avec un professeur qualifié.</p>
    </section>

    <section>
        <h2>4. Comment accéder aux cours en ligne ?</h2>
        <p>Il suffit de se connecter à son espace personnel via <a href="<?php echo BASE_URL; ?>/login">la page de connexion</a>. Une fois connecté, les cours et les visios sont accessibles depuis le tableau de bord.</p>
    </section>

    <section>
        <h2>5. Comment les parents peuvent-ils suivre les progrès ?</h2>
        <p>Les parents disposent d’un tableau de bord détaillé avec un historique des cours suivis, les résultats des exercices et des recommandations pédagogiques.</p>
    </section>

    <section>
        <h2>6. Combien coûte l’inscription ?</h2>
        <p>Les prix varient en fonction du niveau scolaire et de la formule choisie. Pour plus d’informations, consultez <a href="<?php echo BASE_URL; ?>/purchase">la page d’achat</a>.</p>
    </section>

    <section>
        <h2>7. Puis-je contacter un professeur ?</h2>
        <p>Oui, une messagerie sécurisée est disponible pour échanger avec les enseignants depuis votre espace élève ou parent.</p>
    </section>

    <section>
        <h2>8. Mon enfant est-il en sécurité sur la plateforme ?</h2>
        <p>Oui, DomoSchool respecte les normes de sécurité et de confidentialité. Les données personnelles sont protégées et les interactions sont modérées.</p>
    </section>

    <section>
        <h2>9. Comment contacter le support ?</h2>
        <p>Vous pouvez nous écrire depuis <a href="<?php echo BASE_URL; ?>/contact">la page de contact</a>. Nous répondons sous 24 à 48 heures ouvrées.</p>
    </section>
</div>

<?php include('../../includes/footer.php'); ?>

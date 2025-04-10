<?php include('includes/header.php'); ?>

<div class="container">
    <section style="text-align: center; margin-bottom: 50px;">
        <h1>Bienvenue sur <span style="color: var(--primary);">DomoSchool</span></h1>
        <p style="font-size: 1.2rem; max-width: 700px; margin: 20px auto;">
            DomoSchool est votre plateforme d'éducation moderne. Cours particuliers en ligne, exercices interactifs, 
            suivi en temps réel... tout pour garantir la réussite scolaire de vos enfants.
        </p>
        <a href="login.php">
            <button style="margin: 10px;">Se connecter</button>
        </a>
        <a href="register.php">
            <button style="margin: 10px; background-color: #10b981;">Créer un compte</button>
        </a>
    </section>

    <section>
        <h2 style="text-align: center;">Nos avantages</h2>
        <div style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 30px; margin-top: 30px;">
            <div style="flex: 1 1 250px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px var(--shadow);">
                <h3>📚 Cours personnalisés</h3>
                <p>Des parcours adaptés au niveau et au rythme de chaque élève.</p>
            </div>
            <div style="flex: 1 1 250px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px var(--shadow);">
                <h3>🎥 Visioconférence en direct</h3>
                <p>Apprenez avec un vrai professeur en direct, depuis chez vous.</p>
            </div>
            <div style="flex: 1 1 250px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px var(--shadow);">
                <h3>📈 Suivi parental</h3>
                <p>Des tableaux de bord clairs pour suivre les progrès de vos enfants.</p>
            </div>
        </div>
    </section>
</div>

<?php include('includes/footer.php'); ?>

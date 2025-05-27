<?php include('../includes/header.php'); ?>



<div class="container">

    <!-- Section d’intro -->
    <section style="text-align: center; margin-bottom: 50px;">
        <h1>Bienvenue sur <span style="color: var(--primary);">DomoSchooll</span></h1>
        <p style="font-size: 1.2rem; max-width: 700px; margin: 20px auto;">
            DomoSchool est votre plateforme d'éducation moderne. Cours particuliers en ligne, exercices interactifs, 
            suivi en temps réel... tout pour garantir la réussite scolaire de vos enfants.
        </p>
        <?php if (!$isLoggedIn): ?>
            <a href="auth/login.php">
                <button style="margin: 10px;">Se connecter</button>
            </a>
            <a href="auth/register.php">
                <button style="margin: 10px; background-color: #10b981;">Créer un compte</button>
            </a>
        <?php else: ?>
            <a href="eleve/courses.php">
                <button style="margin: 10px; background-color: var(--primary); color: white;">
                    📘 Voir les cours
                </button>
            </a>
        <?php endif; ?>


    </section>

    <!-- Avantages -->
    <section>
        <h2 style="text-align: center;">Nos avantages</h2>
        <div style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 30px; margin-top: 30px;">
            <a href="eleve/courses.php">
                <div class="card">
                    <h3>📚 Cours personnalisés</h3>
                    <p>Des parcours adaptés au niveau et au rythme de chaque élève.</p>
                </div>
            </a>
            <div class="card">
                <h3>🎥 Visioconférence en direct</h3>
                <p>Apprenez avec un vrai professeur en direct, depuis chez vous.</p>
            </div>
            <div class="card">
                <h3>📈 Suivi parental</h3>
                <p>Des tableaux de bord clairs pour suivre les progrès de vos enfants.</p>
            </div>
        </div>
    </section>

    <!-- Qui sommes-nous -->
    <section style="margin: 80px 0;">
        <h2 style="text-align: center;">Qui sommes-nous ?</h2>
        <p style="max-width: 800px; margin: 20px auto; font-size: 1.1rem; text-align: center;">
            DomoSchool est une initiative française dédiée à l’accompagnement scolaire. Nous rassemblons des enseignants passionnés, des développeurs éducatifs et des parents engagés pour offrir un environnement d’apprentissage moderne, bienveillant et efficace.
        </p>
    </section>

    <!-- Derniers ajouts -->
    <section>
        <h2 style="text-align: center;">🆕 Derniers ajouts</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 30px;">
            <div class="card">
                <h3>🔢 Nouveau module : Fractions</h3>
                <p>Un module interactif pour maîtriser les bases des fractions dès le primaire.</p>
            </div>
            <div class="card">
                <h3>🧪 Sciences - Niveau 5e</h3>
                <p>Des vidéos courtes et des quiz sur l’énergie, la matière et l’environnement.</p>
            </div>
            <div class="card">
                <h3>🧠 Préparation brevet</h3>
                <p>Une série d’exercices corrigés pour briller le jour de l’examen.</p>
            </div>
        </div>
    </section>

    <!-- Défi du jour -->
    <section style="margin: 80px 0;">
        <h2 style="text-align: center;">🏆 Défi du jour</h2>
        <div class="card" style="max-width: 700px; margin: 30px auto; text-align: center;">
            <h3>💡 Résous cette énigme mathématique :</h3>
            <p style="margin: 20px 0;">
                Si 3 chats attrapent 3 souris en 3 minutes, combien de chats faut-il pour attraper 100 souris en 100 minutes ?
            </p>
            <button onclick="alert('Réfléchis bien à la proportion 😉')">Je tente ma chance !</button>
        </div>
    </section>

    <!-- Témoignages -->
    <section style="margin-bottom: 80px;">
        <h2 style="text-align: center;">✨ Ils nous font confiance</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; margin-top: 30px;">
            <div class="card" style="max-width: 300px;">
                <p>“Grâce à DomoSchool, ma fille a repris confiance en elle et adore apprendre !”</p>
                <strong>— Claire, maman de Louise (6e)</strong>
            </div>
            <div class="card" style="max-width: 300px;">
                <p>“Les cours sont dynamiques et bien faits. Mention spéciale aux quiz interactifs !”</p>
                <strong>— Julien, élève de 3e</strong>
            </div>
            <div class="card" style="max-width: 300px;">
                <p>“Une plateforme très complète avec un suivi pédagogique de qualité.”</p>
                <strong>— M. Durand, professeur de maths</strong>
            </div>
        </div>
    </section>

</div>

<?php include('../includes/footer.php'); ?>

<?php include('../includes/header.php'); ?>


<div class="container homepage-container">
    <?php include('../includes/notif.php'); ?>
    <section class="hero">
        <div class="hero-content">
            <h1>Devenez un As de la NSI avec <span class="primary-color">DomoSchool</span></h1>
            <p class="hero-subtitle">Votre tremplin vers la maîtrise du Numérique et des Sciences Informatiques.</p>
            <p class="hero-description">
                Plongez dans un univers d'apprentissage interactif conçu spécialement pour les élèves de NSI. Découvrez des cours vidéo captivants, des exercices pratiques et des projets stimulants pour exceller dans cette discipline essentielle.

            </p>
            <div class="hero-buttons">
                <?php if (!$isLoggedIn): ?>
                    <a href="<?= BASE_URL ?>/login" class="button primary">Se connecter</a>
                    <a href="<?= BASE_URL ?>/register" class="button secondary">Créer un compte</a>

                <?php else: ?>
                    <a href="<?= BASE_URL ?>/eleve/courses" class="button primary">
                        <i class="fas fa-code"></i> Accéder aux cours NSI
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="hero-image">
            <img src="<?= BASE_URL ?>/assets/images/Acceuil.png" alt="Illustration de concepts NSI">
        </div>
    </section>

    <section class="benefits-nsi">
        <h2 class="section-title">Pourquoi choisir DomoSchool pour la NSI ?</h2>
        <div class="benefits-grid">
            <div class="benefit-item">
                <i class="fas fa-play-circle benefit-icon"></i>
                <h3>Cours Captivants</h3>
                <p>Des explications claires et des démonstrations visuelles pour faciliter la compréhension des concepts complexes.</p>
            </div>
            <div class="benefit-item">
                <i class="fas fa-keyboard benefit-icon"></i>
                <h3>Exercices et Corrigés</h3>
                <p>Mettez en pratique vos connaissances avec des exercices auto-corrigés et des solutions détaillées.</p>
            </div>
            <div class="benefit-item">
                <i class="fas fa-project-diagram benefit-icon"></i>
                <h3>Projets Pratiques et Concrets</h3>
                <p>Développez vos compétences en réalisant des projets qui vous plongent au cœur des problématiques informatiques.</p>
            </div>
            <div class="benefit-item">
                <i class="fas fa-puzzle-piece benefit-icon"></i>
                <h3>Apprentissage Progressif</h3>
                <p>Un parcours structuré qui vous guide étape par étape, des bases aux concepts avancés de la NSI.</p>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <h2 class="section-title">À propos de DomoSchool</h2>
        <div class="about-content">
            <div class="about-text">
                <p><strong>DomoSchool</strong> est né de la passion de <strong>Nathan</strong>, un ancien élève de NSI désireux de rendre cette discipline à la fois accessible et stimulante pour tous les lycéens.</p>
                <p>Fort de son expérience, Nathan a conçu une plateforme où l'apprentissage de la NSI se fait de manière interactive, avec des ressources pédagogiques adaptées aux programmes scolaires et aux défis rencontrés par les élèves.</p>
                <p>Rejoignez la communauté DomoSchool et bénéficiez d'un accompagnement personnalisé pour réussir votre parcours en Numérique et Sciences Informatiques.</p>
            </div>
            <div class="about-image">
                <img src="<?= BASE_URL ?>/assets/images/photo-nathan.jpg" alt="Fondateur de DomoSchool, Nathan">
            </div>
        </div>
    </section>

    <section class="current-subjects" id="subjects">
        <h2 class="section-title">Notre Matière Actuelle</h2>
        <div class="subjects-grid">
            <div class="subject-card nsi-card">
                <i class="fas fa-code subject-icon"></i>
                <h3>Numérique et Sciences Informatiques (NSI)</h3>
                <p>Maîtrisez les fondamentaux de la programmation, des algorithmes, des bases de données, des réseaux et de la pensée computationnelle.</p>
                <a href="<?= BASE_URL ?>/eleve/courses" class="button subtle">Explorer les cours NSI</a>
            </div>
        </div>
    </section>

    <section class="coming-soon">
        <h2 class="section-title">Et bientôt, encore plus de matières pour votre réussite !</h2>
        <p class="coming-soon-intro">Nous élargissons constamment notre offre pour vous accompagner dans d'autres disciplines essentielles au lycée.</p>
        <div class="soon-grid">
            <div class="soon-card">
                <i class="fas fa-book-open soon-icon"></i>
                <h3>NSI Première</h3>
                <p>Explorer les bases du numérique d’aujourd’hui et les fondements de demain en concevant des algorithmes, des programmes et des objets connectés.</p>
                <span class="soon-status">En développement</span>
            </div>
            <div class="soon-card">
                <i class="fas fa-chart-bar soon-icon"></i>
                <h3>Mathématiques</h3>
                <p>Des exercices progressifs et des explications détaillées pour renforcer vos compétences en algèbre, géométrie, analyse...</p>
                <span class="soon-status">En planification</span>
            </div>
            <div class="soon-card">
                <i class="fas fa-atom soon-icon"></i>
                <h3>Sciences Physiques</h3>
                <p>Des cours interactifs pour explorer la mécanique, l'électricité, l'optique et bien d'autres domaines.</p>
                <span class="soon-status">En planification</span>
            </div>
        </div>
    </section>

    <!--
    <section class="testimonials">
        <h2 class="section-title">Ce que les élèves de NSI disent de DomoSchool</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <i class="fas fa-user-circle fa-4x"></i>
                <p>“DomoSchool m'a vraiment aidé à comprendre les algorithmes et la programmation en Python. Les exercices sont super !”</p>
                <strong class="testimonial-author">Léa, Terminale NSI</strong>
            </div>
            <div class="testimonial-card">
                <i class="fas fa-user-circle fa-4x"></i>
                <p>“Les cours sont bien structurés et les projets sont une excellente façon de mettre en pratique ce qu'on apprend.”</p>
                <strong class="testimonial-author">Maxime, Première NSI</strong>
            </div>
        </div>
    </section>
    -->

</div>


<button class="back-to-top"  onclick="scrollToTop()">
    <i class="fas fa-arrow-up"></i>
</button>

<?php include('../includes/footer.php'); ?>





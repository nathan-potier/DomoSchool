<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

$userSessionData = getUserSessionData();
$isLoggedIn = $userSessionData['isLoggedIn'];

// Récupérer les exercices
$exercises = getExercises();

$isFirstExercise = true;
?>

<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>📚 Exercices</h1>
    <div class="content-with-sidebar">
        <div class="main-content">
            <?php foreach ($exercises as $exercise): ?>
                <?php
                // Création d'un id propre pour chaque exercice en remplaçant les espaces par des tirets
                $exerciseId = strtolower(str_replace(' ', '-', $exercise['title']));
                ?>
                <div class="chapter-card" id="<?= htmlspecialchars($exerciseId) ?>">
                    <div class="chapter-header">
                        <h3><?= htmlspecialchars($exercise['title']) ?></h3>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <div class="courses-list">
                        <a href="<?= BASE_URL . '/exercice/' . $exercise['id'] ?>">
                            <div class="course-item">
                                <p class="description">📖 <?= htmlspecialchars($exercise['description']) ?></p>

                                <?php if (!$isLoggedIn && !$isFirstExercise): ?>
                                    <p class="warning">Veuillez vous connecter pour accéder à cet exercice.</p>
                                <?php endif; ?>
                            </div>
                        </a>
                        <?php $isFirstExercise = false; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <aside class="sidebar">
            <h2>📝 Sommaire</h2>
            <ul>
                <?php foreach ($exercises as $exercise): ?>
                    <?php
                    // Création de l'id propre pour chaque exercice dans le sommaire
                    $exerciseId = strtolower(str_replace(' ', '-', $exercise['title']));
                    ?>
                    <li>
                        <a href="#<?= htmlspecialchars($exerciseId) ?>">
                            <?= htmlspecialchars($exercise['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>

<?php include(__DIR__ . '/../../includes/footer.php'); ?>

<script>
  document.querySelectorAll('.chapter-card').forEach(card => {
    card.addEventListener('click', function(e) {
      // Si on a cliqué sur un lien à l’intérieur, on laisse le lien faire son boulot
      if (e.target.closest('a')) return;

      // Sinon, on bascule l’ouverture de la carte
      this.classList.toggle('open');
    });
  });
</script>

<script>
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        // Récupérer l'ID de l'exercice à partir du href
        const exerciseId = this.getAttribute('href').substring(1); // On enlève le "#" du href
        const target = document.querySelector('#' + exerciseId);

        // Vérifier si la carte de l'exercice existe et l'ouvrir
        const exerciseCard = document.querySelector('.chapter-card#' + exerciseId);
        if (exerciseCard) {
            exerciseCard.classList.add('open');  // On ouvre la carte de l'exercice
        }

        // Vérifier si la cible existe et faire défiler la page
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>

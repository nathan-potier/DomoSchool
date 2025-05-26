<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

$userSessionData = getUserSessionData();
$isLoggedIn = $userSessionData['isLoggedIn'];

// Récupérer les sujets de révision pour le bac NSI
$revisionTopics = getRevisionTopics();

$isFirstTopic = true;
?>

<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>📚 Révisions Bac NSI</h1>
    <div class="content-with-sidebar">
        <div class="main-content">
            <?php foreach ($revisionTopics as $topic => $subtopics): ?>
                <?php
                // Création d'un id propre pour chaque sujet en remplaçant les espaces par des tirets
                $topicId = strtolower(str_replace(' ', '-', $topic));
                ?>
                <div class="topic-card" id="<?= htmlspecialchars($topicId) ?>">
                    <div class="topic-header">
                        <h3><?= htmlspecialchars($topic) ?></h3>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <div class="subtopics-list">
                        <?php foreach ($subtopics as $subtopic): ?>
                            <a href="<?= BASE_URL . '/revision/' . $subtopic['id'] ?>">
                                <div class="subtopic-item">
                                    <?= htmlspecialchars($subtopic['title']) ?>
                                    <p class="description">📖 <?= htmlspecialchars($subtopic['description']) ?></p>

                                    <?php if (!$isLoggedIn && !$isFirstTopic): ?>
                                        <p class="warning">Veuillez vous connecter pour accéder à ce sujet.</p>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <?php $isFirstTopic = false; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <aside class="sidebar">
            <h2>📝 Sommaire</h2>
            <ul>
                <?php foreach ($revisionTopics as $topic => $_): ?>
                    <?php
                    // Création de l'id propre pour chaque sujet dans le sommaire
                    $topicId = strtolower(str_replace(' ', '-', $topic));
                    ?>
                    <li>
                        <a href="#<?= htmlspecialchars($topicId) ?>">
                            <?= htmlspecialchars($topic) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>

<?php include(__DIR__ . '/../../includes/footer.php'); ?>

<script>
  document.querySelectorAll('.topic-card').forEach(card => {
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

        // Récupérer l'ID du sujet à partir du href
        const topicId = this.getAttribute('href').substring(1); // On enlève le "#" du href
        const target = document.querySelector('#' + topicId);

        // Vérifier si la carte du sujet existe et l'ouvrir
        const topicCard = document.querySelector('.topic-card#' + topicId);
        if (topicCard) {
            topicCard.classList.add('open');  // On ouvre la carte du sujet
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

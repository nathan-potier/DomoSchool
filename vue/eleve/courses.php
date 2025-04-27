<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

$userSessionData = getUserSessionData();
$isLoggedIn = $userSessionData['isLoggedIn'];

$courses = getCourses();

// Regrouper les cours par chapitre
$chapters = [];
foreach ($courses as $course) {
    $chapterName = $course['chapter_name'];
    if (!isset($chapters[$chapterName])) {
        $chapters[$chapterName] = [];
    }
    $chapters[$chapterName][] = $course;
}

$isFirstCourse = true; 
?>

<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>📚 Cours par Chapitre</h1>
    <div class="content-with-sidebar">
        <div class="main-content">
            <?php foreach ($chapters as $chapter => $courses): ?>
                <?php 
                // Création d'un id propre pour chaque chapitre en remplaçant les espaces par des tirets
                $chapterId = strtolower(str_replace(' ', '-', $chapter));
                ?>
                <div class="chapter-card" id="<?= htmlspecialchars($chapterId) ?>">
                    <div class="chapter-header">
                        <h3><?= htmlspecialchars($chapter) ?></h3>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <div class="courses-list">
                        <?php foreach ($courses as $course): ?>
                            <a href="../view_course.php?course_id=<?= $course['id'] ?>">
                                <div class="course-item">
                                    <?= htmlspecialchars($course['title']) ?>
                                    <p class="teacher">👨‍🏫 <?= htmlspecialchars($course['teacher_first_name'] . ' ' . $course['teacher_last_name']) ?></p>
                                    
                                    <?php if (!$isLoggedIn && !$isFirstCourse): ?>
                                        <p class="warning">Veuillez vous connecter pour accéder à ce cours.</p>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <?php $isFirstCourse = false; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <aside class="sidebar">
            <h2>📝 Sommaire</h2>
            <ul>
                <?php foreach ($chapters as $chapter => $_): ?>
                    <?php 
                    // Création de l'id propre pour chaque chapitre dans le sommaire
                    $chapterId = strtolower(str_replace(' ', '-', $chapter));
                    ?>
                    <li>
                        <a href="#<?= htmlspecialchars($chapterId) ?>">
                            <?= htmlspecialchars($chapter) ?>
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
        
        // Récupérer l'ID du chapitre à partir du href
        const chapterId = this.getAttribute('href').substring(1); // On enlève le "#" du href
        const target = document.querySelector('#' + chapterId);

        // Vérifier si la carte du chapitre existe et l'ouvrir
        const chapterCard = document.querySelector('.chapter-card#' + chapterId);
        if (chapterCard) {
            chapterCard.classList.add('open');  // On ouvre la carte du chapitre
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

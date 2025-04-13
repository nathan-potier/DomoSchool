<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();
checkAuth();

$userSessionData = getUserSessionData();
if (!$userSessionData['isLoggedIn']) {
    header('Location: login.php');
    exit;
}

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
?>

<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>📚 Cours par Chapitre</h1>
    <div class="content-with-sidebar">
        <div class="main-content">
            <?php foreach ($chapters as $chapter => $courses): ?>
                <div class="chapter-card" id="<?= htmlspecialchars(str_replace(' ', '-', strtolower($chapter))) ?>">
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
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <aside class="sidebar">
            <h2>📝 Sommaire</h2>
            <ul>
                <?php foreach ($chapters as $chapter => $_): ?>
                    <li>
                        <a class="" href="#<?= htmlspecialchars(str_replace(' ', '-', strtolower($chapter))) ?>">
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
  const header = card.querySelector('.chapter-header');
  header.addEventListener('click', () => {
    card.classList.toggle('open');
  });
});
</script>

<script>
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>



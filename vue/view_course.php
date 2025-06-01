<?php
require_once __DIR__ . '/../includes/functions.php';
startSession();

$userId = $_SESSION['user_id'] ?? null; // Récupère l'utilisateur connecté s'il y en a un

// Vérifie si un ID de cours a été passé dans l'URL
if (isset($_GET['course_id'])) {
    $courseId = (int) $_GET['course_id'];

    // Récupère les informations du cours
    $course = getCourseById($courseId);
    $courses = getCourses();
    $firstCourse = $courses[0];

    // Si ce n’est pas le premier cours, vérifie que l'utilisateur est connecté
    if ($course['id'] !== $firstCourse['id']) {
        checkAuth();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
        if (isset($_POST['complete_course'])) {
            $timeSpentMinutes = isset($_POST['time_spent']) ? (int) $_POST['time_spent'] : 1;
            $result = markCourseAsRead($userId, $courseId, $timeSpentMinutes);
            echo $result ? "<p>Cours marqué comme lu !</p>" : "<p>Erreur lors de la mise à jour du cours.</p>";
        }

        if (isset($_POST['uncomplete_course'])) {
            $result = unmarkCourseAsRead($userId, $courseId);
            echo $result ? "<p>Cours marqué comme non lu.</p>" : "<p>Erreur lors de l'annulation.</p>";
        }
    }



} else {
    $course = null;
}

include(__DIR__ . '/../includes/header.php');
?>

<!-- Lien vers le fichier CSS -->
<link rel="stylesheet" href="../path/to/style.css">

<div class="container content-wrapper">
    <?php
    if ($course) {
        echo "<div class='course-container'>";

        $filePath = BASE_URL . $course['file_path'];

        if (!empty($course['file_path']) && pathinfo($course['file_path'], PATHINFO_EXTENSION) == 'html') {
            echo "<iframe src='$filePath' id='course-iframe' width='100%' frameborder='0' scrolling='no' onload='resizeIframe(this)'></iframe>";
        } elseif (!empty($course['file_path'])) {
            echo '<a href="'. BASE_URL . htmlspecialchars($course['file_path']) . '" target="_blank">Télécharger le cours</a>';
        }

        echo "</div>";

        if ($userId) {
            if (hasUserReadCourse($userId, $courseId)) {
                echo '<div class="course-complete-button-container">';
                echo '<form method="POST">';
                echo '<button type="submit" name="uncomplete_course" class="course-complete-button cancel">Marquer comme non lu</button>';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<div class="course-complete-button-container">';
                echo '<form method="POST" id="completion-form">';
                echo '<input type="hidden" name="time_spent" id="time_spent_input">';
                echo '<button type="submit" name="complete_course" class="course-complete-button">Marquer comme lu</button>';
                echo '</form>';
                echo '</div>';
            }
        }



    } else {
        echo "<p>ID de cours manquant ou cours non trouvé.</p>";
    }
    ?>
</div>

<?php include(__DIR__ . '/../includes/footer.php'); ?>

<script>
function resizeIframe(iframe) {
    iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}
</script>

<script>
  const iframe = document.getElementById('course-iframe');

  iframe.addEventListener('load', () => {
    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

    // Créer la balise <script>
    const script = iframeDoc.createElement('script');
    script.src = '<?php echo BASE_URL; ?>/assets/js/notion_fix_prism.js';
    script.onload = () => {
      console.log('Script notion_fix_prism chargé dans l\'iframe');
    };

    iframeDoc.head.appendChild(script);
  });
</script>


<script src="<?php echo BASE_URL; ?>/assets/js/listener_time.js" defer></script>

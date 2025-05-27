<?php
require_once __DIR__ . '/../includes/functions.php';
startSession();

$userId = $_SESSION['user_id'] ?? null; // Récupère l'utilisateur connecté s'il y en a un


// Vérifie si un ID d'exercice a été passé dans l'URL
if (isset($_GET['exercice_id'])) {
    $exerciseId = (int) $_GET['exercice_id'];

    // Récupère les informations de l'exercice à partir de la base de données
    $exercise = getExerciseById($exerciseId);

    // Récupère la liste complète des exercices
    $exercises = getExercises();

    // On suppose que les exercices sont récupérés dans un ordre spécifique
    $firstExercise = $exercises[0];

    // Vérifie si l'exercice actuel n'est pas le premier exercice
    if ($exercise['id'] !== $firstExercise['id']) {
        // Si ce n'est pas le premier exercice, vérifie si l'utilisateur est connecté
        checkAuth();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
        if (isset($_POST['complete_course'])) {
            $timeSpentMinutes = isset($_POST['time_spent']) ? (int) $_POST['time_spent'] : 1;
            $result = markExerciseAsCompleted($userId, $exerciseId, $timeSpentMinutes);
            echo $result ? "<p>Exercice marqué comme fait !</p>" : "<p>Erreur lors de l'enregistrement.</p>";
        }

        if (isset($_POST['uncomplete_exercise'])) {
            $result = unmarkExerciseAsCompleted($userId, $exerciseId);
            echo $result ? "<p>Exercice marqué comme non fait.</p>" : "<p>Erreur lors de l'annulation.</p>";
        }
    }



} else {
    $exercise = null;
}

// Inclure le header
include(__DIR__ . '/../includes/header.php');
?>

<!-- Lien vers le fichier CSS -->
<link rel="stylesheet" href="../path/to/style.css">

<div class="container content-wrapper">
    <?php
    if ($exercise) {
        echo "<div class='exercise-container'>";

        $filePath = BASE_URL . $exercise['file_path'];

        if (!empty($exercise['file_path']) && pathinfo($exercise['file_path'], PATHINFO_EXTENSION) == 'html') {
            echo "<iframe src='$filePath' id='exercise-iframe' width='100%' frameborder='0' scrolling='no' onload='resizeIframe(this)'></iframe>";
        } elseif (!empty($exercise['file_path'])) {
            echo '<a href="'. BASE_URL . htmlspecialchars($exercise['file_path']) . '" target="_blank">Télécharger l\'exercice</a>';
        }

        echo "</div>";

        if ($userId) {
            if (hasUserMakeExercises($userId, $exerciseId)) {
                echo '<div class="course-complete-button-container">';
                echo '<form method="POST">';
                echo '<button type="submit" name="uncomplete_exercise" class="course-complete-button cancel">Marquer comme non fait</button>';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<div class="course-complete-button-container">';
                echo '<form method="POST" id="completion-form">';
                echo '<input type="hidden" name="time_spent" id="time_spent_input">';
                echo '<button type="submit" name="complete_course" class="course-complete-button">Marquer comme fait</button>';
                echo '</form>';
                echo '</div>';
            }
        }

    } else {
        echo "<p>ID d'exercice manquant ou exercice non trouvé.</p>";
    }
    ?>
</div>

<?php
include(__DIR__ . '/../includes/footer.php');
?>

<script>
function resizeIframe(iframe) {
    iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}
</script>


<script src="<?php echo BASE_URL; ?>/assets/js/listener_time.js" defer></script>
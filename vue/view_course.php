<?php
require_once __DIR__ . '/../includes/functions.php';
startSession();

// Vérifie si l'utilisateur est connecté
checkAuth();
$userSessionData = getUserSessionData();
if (!$userSessionData['isLoggedIn']) {
    header('Location: login.php');
    exit;
}

// Vérifie si un ID de cours a été passé dans l'URL
if (isset($_GET['course_id'])) {
    $courseId = (int) $_GET['course_id'];

    // Récupère les informations du cours à partir de la base de données
    $course = getCourseById($courseId);  // Assurez-vous que cette fonction existe pour récupérer les détails du cours
} else {
    $course = null; // Si l'ID du cours n'est pas passé, aucun cours à afficher
}

// Inclure le header
include(__DIR__ . '/../includes/header.php');
?>

<!-- Lien vers le fichier CSS -->
<link rel="stylesheet" href="../path/to/style.css">

<div class="content-wrapper">
    <?php
    if ($course) {
        // Si le cours existe, afficher son contenu
        echo "<div class='course-container'>";

        // Vérification du chemin du fichier HTML
        $filePath = BASE_URL . $course['file_path'];
   
        // Si le cours est un fichier .html, l'inclure dans un iframe
        if (!empty($course['file_path']) && pathinfo($course['file_path'], PATHINFO_EXTENSION) == 'html') {
            // Inclure le fichier HTML dans un iframe avec un événement onload pour ajuster la hauteur
            echo "<iframe src='$filePath' id='course-iframe' width='100%' frameborder='0' scrolling='no' onload='resizeIframe(this) '></iframe>";
        } elseif (!empty($course['file_path'])) {
            // Si le cours a un fichier autre que .html, fournir un lien de téléchargement
            echo '<a href="'. BASE_URL . htmlspecialchars($course['file_path']) . '" target="_blank">Télécharger le cours</a>';
        }

        echo "</div>";
    } else {
        // Si le cours n'existe pas ou l'ID est invalide
        echo "<p>ID de cours manquant ou cours non trouvé.</p>";
    }
    ?>
</div>

<?php
// Inclure le footer
include(__DIR__ . '/../includes/footer.php');
?>

<!-- Script JavaScript pour ajuster la hauteur de l'iframe -->
<script>
function resizeIframe(iframe) {
    iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}
</script>

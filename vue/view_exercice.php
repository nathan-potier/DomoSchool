<?php
require_once __DIR__ . '/../includes/functions.php';
startSession();

// Vérifie si un ID d'exercice a été passé dans l'URL
if (isset($_GET['exercice_id'])) {
    $exerciseId = (int) $_GET['exercice_id'];

    // Récupère les informations de l'exercice à partir de la base de données
    $exercise = getExerciseById($exerciseId);  // Assurez-vous que cette fonction existe pour récupérer les détails de l'exercice

    // Récupère la liste complète des exercices
    $exercises = getExercises();

    // On suppose que les exercices sont récupérés dans un ordre spécifique (par exemple, par ID croissant ou autre critère logique)
    // Vérifie si l'ID du premier exercice dans la liste correspond à l'ID du premier exercice dans la base de données
    $firstExercise = $exercises[0];  // Le premier exercice dans le tableau

    // Vérifie si l'exercice actuel n'est pas le premier exercice
    if ($exercise['id'] !== $firstExercise['id']) {
        // Si ce n'est pas le premier exercice, vérifie si l'utilisateur est connecté
        checkAuth();
    }

} else {
    $exercise = null; // Si l'ID de l'exercice n'est pas passé, aucun exercice à afficher
}

// Inclure le header
include(__DIR__ . '/../includes/header.php');
?>

<!-- Lien vers le fichier CSS -->
<link rel="stylesheet" href="../path/to/style.css">

<div class="container content-wrapper">
    <?php
    if ($exercise) {
        // Si l'exercice existe, afficher son contenu
        echo "<div class='exercise-container'>";

        // Vérification du chemin du fichier HTML
        $filePath = BASE_URL . $exercise['file_path'];

        // Si l'exercice est un fichier .html, l'inclure dans un iframe
        if (!empty($exercise['file_path']) && pathinfo($exercise['file_path'], PATHINFO_EXTENSION) == 'html') {
            // Inclure le fichier HTML dans un iframe avec un événement onload pour ajuster la hauteur
            echo "<iframe src='$filePath' id='exercise-iframe' width='100%' frameborder='0' scrolling='no' onload='resizeIframe(this)'></iframe>";
        } elseif (!empty($exercise['file_path'])) {
            // Si l'exercice a un fichier autre que .html, fournir un lien de téléchargement
            echo '<a href="'. BASE_URL . htmlspecialchars($exercise['file_path']) . '" target="_blank">Télécharger l\'exercice</a>';
        }

        echo "</div>";
    } else {
        // Si l'exercice n'existe pas ou l'ID est invalide
        echo "<p>ID d'exercice manquant ou exercice non trouvé.</p>";
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

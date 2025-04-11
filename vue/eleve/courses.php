<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

// Vérifie si l'utilisateur est connecté
checkAuth();
$userSessionData = getUserSessionData();
if (!$userSessionData['isLoggedIn']) {
    header('Location: login.php');
    exit;
}


// Récupère les cours disponibles
$courses = getCourses();




?>

<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>Liste des Cours</h1>

    <!-- Liste des cours -->
    <table class="table">
        <thead>
            <tr>
                <th>Titre du Cours</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($courses as $course) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($course['title']) . '</td>';
                echo '<td>' . htmlspecialchars($course['description']) . '</td>';
                echo '<td>' . htmlspecialchars($course['chapter_name']) . '</td>';
                echo '<td>' . htmlspecialchars($course['teacher_first_name']) . ' ' . htmlspecialchars($course['teacher_last_name']) . '</td>';
                echo '<td><a href="../view_course.php?course_id=' . $course['id'] . '" class="btn btn-primary">Voir le cours</a></td>';
                echo '</tr>';
            }?>
        </tbody>
    </table>
</div>

<?php include(__DIR__ . '/../../includes/footer.php'); ?>

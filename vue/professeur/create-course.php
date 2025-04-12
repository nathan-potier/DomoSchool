<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

checkAuth();  // Vérifie si l'utilisateur est connecté et autorisé à créer un cours (peut-être un professeur ou un admin)

// Vérifier si l'utilisateur est connecté avant de procéder
$userSessionData = getUserSessionData();
if (!$userSessionData['isLoggedIn']) {
    header('Location: login.php');
    exit;
}

// Vérifier si l'utilisateur est un professeur ou admin
if ($userSessionData['userRole'] !== 'teacher' && $userSessionData['userRole'] !== 'admin') {
    // Si l'utilisateur n'est ni professeur ni admin, rediriger
    header('Location: dashboard.php');
    exit;
}

// Récupérer les chapitres disponibles
$chapters = getChapters(); // Cette fonction doit renvoyer tous les chapitres

// Traiter le formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    $chapterId = intval($_POST['chapter_id']);
    $filePath = ''; // Par défaut, pas de fichier de cours

        // Si un fichier a été téléchargé
    if (isset($_FILES['file_course']) && $_FILES['file_course']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['file_course']['name'];
        $fileTmpName = $_FILES['file_course']['tmp_name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExts = ['pdf', 'docx', 'txt', 'html']; // Extensions autorisées
        $uploadDir = '../../uploads/courses/'; // Répertoire d'upload sur le serveur

        // Vérifier si l'extension du fichier est autorisée
        if (in_array($fileExt, $allowedExts)) {
            $newFileName = uniqid('course_') . '.' . $fileExt;
            $filePath = '/uploads/courses/' . $newFileName; // Chemin relatif à la racine publique

            // Créer le répertoire s'il n'existe pas
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Création du répertoire avec les bons droits
            }

            // Déplacer le fichier téléchargé
            if (move_uploaded_file($fileTmpName, $uploadDir . $newFileName)) {
                // Fichier téléchargé avec succès
            } else {
                echo "Erreur lors du téléchargement du fichier.";
                exit;
            }
        } else {
            echo "Type de fichier non autorisé.";
            exit;
        }
    }


    // Insérer le cours dans la base de données
    $teacherId = $_SESSION['user_id']; // Assigner l'ID du professeur
    $query = "INSERT INTO courses (title, description, teacher_id, file_path, chapter_id) 
              VALUES (?, ?, ?, ?, ?)";

    $stmt = $connex->prepare($query);
    $stmt->execute([$title, $description, $teacherId, $filePath, $chapterId]);

    // Rediriger vers la page de confirmation ou de détail
    header('Location: create-course.php?success=Cours créé avec succès.');
    exit;
}
?>

<!-- Inclure le header -->
<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    
    <h1>Créer un nouveau cours</h1>
    <?php include('../../includes/notif.php'); ?>
    <!-- Formulaire pour créer un cours -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre du Cours</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description du Cours</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="chapter_id">Chapitre</label>
            <select name="chapter_id" id="chapter_id" class="form-control" required>
                <option value="">Sélectionner un chapitre</option>
                <?php foreach ($chapters as $chapter): ?>
                    <option value="<?= $chapter['id'] ?>"><?= htmlspecialchars($chapter['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="file_course">Télécharger un fichier du cours</label>
            <input type="file" name="file_course" id="file_course" class="form-control" accept=".pdf, .docx, .txt, .html">
        </div>

        <button type="submit" class="btn btn-primary">Créer le Cours</button>
    </form>
</div>

<!-- Inclure le footer -->
<?php include(__DIR__ . '/../../includes/footer.php'); ?>

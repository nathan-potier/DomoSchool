<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

checkAuth();  // Vérifie si l'utilisateur est connecté et autorisé à créer un exercice (peut-être un professeur ou un admin)

// Vérifier si l'utilisateur est connecté avant de procéder
$userSessionData = getUserSessionData();
if (!$userSessionData['isLoggedIn']) {
    header('Location: ' . BASE_URL . '/login');
    exit;
}

// Vérifier si l'utilisateur est un professeur ou admin
if ($userSessionData['userRole'] !== 'teacher' && $userSessionData['userRole'] !== 'admin') {
    // Si l'utilisateur n'est ni professeur ni admin, rediriger
    header('Location: ' . BASE_URL . '/professeur/dashboard');
    exit;
}

// Traiter le formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    $language = sanitizeInput($_POST['language']);
    $filePath = ''; // Par défaut, pas de fichier d'exercice

    // Si un fichier a été téléchargé
    if (isset($_FILES['file_exercise']) && $_FILES['file_exercise']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['file_exercise']['name'];
        $fileTmpName = $_FILES['file_exercise']['tmp_name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExts = ['pdf', 'docx', 'txt', 'html']; // Extensions autorisées
        $uploadDir = '../../uploads/exercices/'; // Répertoire d'upload sur le serveur pour les exercices

        // Vérifier si l'extension du fichier est autorisée
        if (in_array($fileExt, $allowedExts)) {
            $newFileName = uniqid('exercise_') . '.' . $fileExt;
            $filePath = '/uploads/exercices/' . $newFileName; // Chemin relatif à la racine publique

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

    // Insérer l'exercice dans la base de données
    $query = "INSERT INTO exercises (title, description, language, file_path)
              VALUES (?, ?, ?, ?)";

    $stmt = $connex->prepare($query);
    $stmt->execute([$title, $description, $language, $filePath]);

    // Rediriger vers la page de confirmation ou de détail
    header('Location: ' . BASE_URL . '/professeur/create-exercise?success=Exercice créé avec succès.');
    exit;
}
?>

<!-- Inclure le header -->
<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>Créer un nouvel exercice</h1>
    <?php include('../../includes/notif.php'); ?>
    <!-- Formulaire pour créer un exercice -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre de l'exercice</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description de l'exercice</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="language">Langage de programmation</label>
            <select name="language" id="language" class="form-control" required>
                <option value="python">Python</option>
                <option value="javascript">JavaScript</option>
                <option value="java">Java</option>
                <option value="c">C</option>
                <!-- Ajoutez d'autres langages si nécessaire -->
            </select>
        </div>

        <div class="form-group">
            <label for="file_exercise">Télécharger un fichier de l'exercice</label>
            <input type="file" name="file_exercise" id="file_exercise" class="form-control" accept=".pdf, .docx, .txt, .html">
        </div>

        <button type="submit" class="btn btn-primary">Créer l'exercice</button>
    </form>
</div>

<!-- Inclure le footer -->
<?php include(__DIR__ . '/../../includes/footer.php'); ?>

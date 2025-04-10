<?php
// Inclure le fichier de connexion MySQLi

require_once 'includes/db.php';

// Sécurité : Vérifie que la requête est bien un POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit('Accès non autorisé');
}

// Nettoyage et validation des données
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($name) || empty($email) || empty($password)) {
    exit('Tous les champs sont requis.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Adresse email invalide.');
}

if (strlen($password) < 8) {
    exit('Le mot de passe doit contenir au moins 8 caractères.');
}

try {
    // Vérifie si l'email existe déjà
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);  // 's' signifie string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->fetch_assoc()) {
        exit('Un compte avec cet email existe déjà.');
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertion de l'utilisateur
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param('sss', $name, $email, $hashedPassword);  // 'sss' signifie 3 strings
    $stmt->execute();

    // Redirection ou message de succès
    header("Location: login.php?register=success");
    exit;

} catch (mysqli_sql_exception $e) {
    error_log("Erreur MySQLi : " . $e->getMessage());
    exit("Une erreur est survenue. Veuillez réessayer plus tard.");
}
?>
<?php
// Inclure le fichier de connexion MySQLi
require_once 'includes/db.php';

// Sécurité : Vérifie que la requête est bien un POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit('Accès non autorisé');
}

// Nettoyage et validation des données
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($name) || empty($email) || empty($password)) {
    exit('Tous les champs sont requis.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Adresse email invalide.');
}

if (strlen($password) < 8) {
    exit('Le mot de passe doit contenir au moins 8 caractères.');
}

try {
    // Vérifie si l'email existe déjà
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);  // 's' signifie string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->fetch_assoc()) {
        exit('Un compte avec cet email existe déjà.');
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertion de l'utilisateur
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param('sss', $name, $email, $hashedPassword);  // 'sss' signifie 3 strings
    $stmt->execute();

    // Redirection ou message de succès
    header("Location: login.php?register=success");
    exit;

} catch (mysqli_sql_exception $e) {
    error_log("Erreur MySQLi : " . $e->getMessage());
    exit("Une erreur est survenue. Veuillez réessayer plus tard.");
}
?>

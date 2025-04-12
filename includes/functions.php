<?php
require_once __DIR__ . '/db.php';

function startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        $_SESSION['last_activity'] = time();
    }
}

function redirect($url, $statusCode = 303) {
    header('Location: ' . $url, true, $statusCode);
    exit;
}

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => PASSWORD_COST]);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function checkAuth() {
    startSession();

    // Vérifie si l'utilisateur est connecté
    if (empty($_SESSION['user_id'])) {
        redirect(BASE_URL . '/vue/login.php');
    }

    // Initialiser 'last_activity' si elle n'existe pas encore
    if (!isset($_SESSION['last_activity'])) {
        $_SESSION['last_activity'] = time(); // Premier enregistrement de l'activité
    }

    // Vérification du timeout (si la session a expiré)
    if (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
        // Log du timeout
        error_log("Session expirée pour l'utilisateur ID: {$_SESSION['user_id']}");

        session_unset();  // Détruire les variables de session
        session_destroy(); // Détruire la session
        redirect(BASE_URL . '/vue/login.php'); // Redirection vers la page de login
    }

    // Met à jour 'last_activity' à chaque nouvelle activité
    $_SESSION['last_activity'] = time();
}



function logActivity($action, $userId = null) {
    $log = sprintf(
        "[%s] %s: %s %s\n",
        date('Y-m-d H:i:s'),
        $userId ?? 'guest',
        $action,
        $_SERVER['REMOTE_ADDR']
    );
    file_put_contents(LOG_DIR.'/activity.log', $log, FILE_APPEND);
}

function getUserData($userId) {
    global $connex;
    $stmt = $connex->prepare("SELECT id, first_name, last_name, email, role, last_login FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}
function getUserSessionData() {
    // Vérifie si l'utilisateur est connecté et récupère ses données
    if (isset($_SESSION['user_id'])) {
        // Si l'utilisateur est connecté, on récupère ses données depuis la base
        $userData = getUserData($_SESSION['user_id']);
        if ($userData) {
            return [
                'isLoggedIn' => true,
                'userRole' => $userData['role'],
                'userName' => $userData['first_name'] . ' ' . $userData['last_name'],
                'userEmail' => $userData['email'],
                'lastLogin' => $userData['last_login']
            ];
        }
    }
    
    // Si l'utilisateur n'est pas connecté ou que les données sont manquantes
    return [
        'isLoggedIn' => false,
        'userRole' => null,
        'userName' => null,
        'userEmail' => null,
        'lastLogin' => null
    ];
}

function getCourses() {
    global $connex;
    $stmt = $connex->prepare("SELECT c.id, c.title, c.description, c.file_path, ch.name AS chapter_name, u.first_name AS teacher_first_name, u.last_name AS teacher_last_name
                              FROM courses c
                              JOIN users u ON c.teacher_id = u.id
                              LEFT JOIN chapters ch ON c.chapter_id = ch.id
                              WHERE c.id IS NOT NULL");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCourseById($courseId) {
    global $connex;
    $stmt = $connex->prepare("SELECT id, title, description, file_path FROM courses WHERE id = ?");
    $stmt->execute([$courseId]);
    return $stmt->fetch();
}


function getChapters() {
    global $connex;
    $stmt = $connex->prepare("SELECT * FROM chapters ORDER BY name ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function getChildByParent($parentId) {
    global $pdo;
    $sql = "SELECT * FROM users WHERE parent_id = :parent_id AND role = 'student'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':parent_id', $parentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getStudentSchedule($studentId) {
    global $pdo;
    $sql = "
        SELECT courses.title AS course_name, schedule.date, teachers.first_name AS teacher_name
        FROM schedule
        JOIN courses ON schedule.course_id = courses.id
        JOIN users AS teachers ON courses.teacher_id = teachers.id
        WHERE schedule.student_id = :student_id
        ORDER BY schedule.date";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateUserProfile($userId, $firstName, $lastName, $email) {
    global $pdo;
    $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}

function getExercisesByStudent($studentId) {
    global $pdo;
    $sql = "
        SELECT exercises.title, exercises.description
        FROM exercises
        JOIN student_exercises ON exercises.id = student_exercises.exercise_id
        WHERE student_exercises.student_id = :student_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function isAdmin($user) {
    return $user['role'] === 'admin';
}


// Fonction pour exécuter le code Python (en PHP)
function executePythonCode($code) {
    $filename = tempnam(sys_get_temp_dir(), 'python_code_');
    file_put_contents($filename, $code);
    
    $output = shell_exec("python3 $filename 2>&1");
    unlink($filename);  // Supprimer le fichier temporaire
    
    return $output;
}
/* ERREUR
function saveStudentExercise($student_id, $exercise_id, $code) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO student_exercises (student_id, exercise_id, code) VALUES (?, ?, ?)");
    $stmt->execute([$student_id, $exercise_id, $code]);
}*/

?>
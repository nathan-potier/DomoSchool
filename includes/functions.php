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
    if (empty($_SESSION['user_id'])) {
        redirect('/login.php');
    }
    
    // Vérification du timeout
    if (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        redirect('/login.php?timeout=1');
    }
    
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





?>
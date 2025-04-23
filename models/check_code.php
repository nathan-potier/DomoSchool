<?php
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

if(empty($_GET['code'])) {
    echo json_encode(['valid' => false]);
    exit;
}

try {
    $connex = Database::getInstance()->getConnection();
    $stmt = $connex->prepare("SELECT role FROM access_codes WHERE code = ? AND used = FALSE");
    $stmt->execute([$_GET['code']]);
    
    if($row = $stmt->fetch()) {
        echo json_encode(['valid' => true, 'role' => $row['role']]);
    } else {
        echo json_encode(['valid' => false]);
    }
} catch(PDOException $e) {
    error_log('Check Code Error: '.$e->getMessage());
    echo json_encode(['valid' => false]);
}
?>
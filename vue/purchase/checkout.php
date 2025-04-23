<?php
require_once '../../includes/functions.php';

$validRoles = ['student', 'parent'];
$role = $_GET['role'] ?? '';

if(!in_array($role, $validRoles)) {
    redirect('purchase_code.php');
}

// Ici vous intégrerez votre solution de paiement (Stripe, PayPal, etc.)
// Après paiement réussi, générez un code et redirigez

try {
    $connex = Database::getInstance()->getConnection();
    
    // Générer un code unique
    $code = bin2hex(random_bytes(16));
    
    // Insérer le code
    $stmt = $connex->prepare("INSERT INTO access_codes (code, role) VALUES (?, ?)");
    $stmt->execute([$code, $role]);
    
    // Envoyer le code par email ou l'afficher
    $_SESSION['purchased_code'] = $code;
    redirect('purchase_success.php');
    
} catch(PDOException $e) {
    error_log('Checkout Error: '.$e->getMessage());
    redirect('purchase_code.php?error=Erreur lors de la génération du code');
}
?>
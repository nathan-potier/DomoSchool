<?php
require_once '../../includes/functions.php';

$validRoles = ['student', 'parent'];
$role = $_GET['role'] ?? '';

if (!in_array($role, $validRoles)) {
    redirect(BASE_URL . '/purchase'); // URL propre sans .php
}

// Ici, intégration du paiement (Stripe, PayPal, etc.)
// Après paiement réussi, générer un code et rediriger

try {
    $connex = Database::getInstance()->getConnection();

    // Générer un code unique
    $code = bin2hex(random_bytes(16));

    // Insérer le code en base
    $stmt = $connex->prepare("INSERT INTO access_codes (code, role) VALUES (?, ?)");
    $stmt->execute([$code, $role]);

    // Stocker le code dans la session pour l’afficher ensuite
    $_SESSION['purchased_code'] = $code;

    redirect(BASE_URL . '/purchase-success'); // URL propre pour la page de succès

} catch(PDOException $e) {
    error_log('Checkout Error: ' . $e->getMessage());
    redirect(BASE_URL . '/purchase?error=Erreur lors de la génération du code');
}
?>

<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/includes/functions.php';

// Démarrer la session
startSession();

// Vérifier si l'utilisateur est connecté
if (empty($_SESSION['user_id'])) {
    redirect('login.php');
}

// Récupérer les données de l'utilisateur connecté
$user = getUserData($_SESSION['user_id']);
if (!$user) {
    redirect('login.php');
}

// Stocker les informations utilisateur dans des variables
$fullName = $user['first_name'] . ' ' . $user['last_name'];
$role = $user['role'];
$lastLogin = $user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : 'Jamais';
?>

<?php include('includes/header.php'); ?>

<div class="container" style="max-width: 900px; margin-top: 40px;">
    <h1 style="text-align: center; margin-bottom: 30px;">Bienvenue, <?= htmlspecialchars($fullName) ?> !</h1>
    
    <div class="dashboard-info" style="background-color: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h2>Informations personnelles</h2>
        <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Rôle :</strong> <?= ucfirst($role) ?></p>
        <p><strong>Dernière connexion :</strong> <?= $lastLogin ?></p>
    </div>

    <!-- Section : Liens vers les espaces de l'utilisateur -->
    <div class="dashboard-links" style="display: flex; justify-content: space-between; margin-bottom: 40px;">
        <a href="student-dashboard.php" class="btn" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 6px;">Espace Élève</a>
        <a href="parent-dashboard.php" class="btn" style="padding: 10px 20px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 6px;">Espace Parent</a>
        <a href="teacher-dashboard.php" class="btn" style="padding: 10px 20px; background-color: #FF9800; color: white; text-decoration: none; border-radius: 6px;">Espace Professeur</a>
    </div>

    <!-- Section : Statistiques du compte en fonction du rôle -->
    <div class="dashboard-stats" style="background-color: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <h2>Statistiques</h2>

        <?php if ($role === 'student'): ?>
        <p><strong>Cours suivis :</strong> 12</p>
        <p><strong>Exercices terminés :</strong> 25/30</p>
        <p><strong>Progrès actuel :</strong> 83%</p>

        <?php elseif ($role === 'parent'): ?>
        <p><strong>Enfant suivi :</strong> <?= htmlspecialchars($fullName) ?></p>
        <p><strong>Cours en cours :</strong> 6</p>
        <p><strong>Progrès de l'enfant :</strong> 75%</p>

        <?php elseif ($role === 'teacher'): ?>
        <p><strong>Élèves sous votre supervision :</strong> 20</p>
        <p><strong>Cours créés :</strong> 15</p>
        <p><strong>Évaluations à corriger :</strong> 5</p>
        <?php endif; ?>
    </div>

    <!-- Section : Liens pour modifier les informations ou se déconnecter -->
    <div class="dashboard-actions" style="display: flex; justify-content: space-between; margin-top: 40px;">
        <a href="edit-profile.php" class="btn" style="padding: 10px 20px; background-color: #FFC107; color: white; text-decoration: none; border-radius: 6px;">Modifier le profil</a>
        <a href="logout.php" class="btn" style="padding: 10px 20px; background-color: #F44336; color: white; text-decoration: none; border-radius: 6px;">Se déconnecter</a>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php


require_once __DIR__ . '/functions.php';  // Inclure le fichier où la fonction est définie
startSession();  // Démarrer la session si elle n'est pas déjà active


// Récupérer les informations sur l'utilisateur
$userSessionData = getUserSessionData();
$isLoggedIn = $userSessionData['isLoggedIn'];
$userRole = $userSessionData['userRole'];
?>

<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DomoSchool</title>
    <script>
        (function () {
            const savedMode = localStorage.getItem('mode');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const initialMode = savedMode === 'mode-dark' || (!savedMode && systemPrefersDark);

            document.documentElement.classList.add(initialMode ? 'mode-dark' : 'mode-white');
            document.documentElement.classList.add('theme-loaded'); // important !
            document.documentElement.classList.remove('no-js');

        })();
    </script>
    


    <title>DomoSchool</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <script src="<?php echo BASE_URL; ?>/assets/js/menuBurger.js" defer></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/main.js" defer></script>
</head>
<body>
    <header>

        <!-- Bouton Dark Mode -->
        <form name="mytheme" class="theme-toggle">
            <label class="btToggle">
                <span class="btn">
                    <input type="checkbox" name="theme-mode">
                    <span class="slider">
                        <span class="sun">🌙</span>
                        <span class="moon">☀️</span>
                    </span>
                </span>
            </label>
        </form>
        <div class="logo">
            <a href="<?php echo BASE_URL; ?>/vue/index.php">
                <img class="header-content" src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="Logo" class="header-profile">
            </a>
        </div>
        

        <div class="boutonBurger">
            <span class="span1"></span>
            <span class="span2"></span>
            <span class="span3"></span>
        </div>
        
        <nav class="menuBurger">
            <a href="<?php echo BASE_URL; ?>/vue/index.php">Accueil</a>
            <?php if (!$isLoggedIn): ?>
                <a href="<?php echo BASE_URL; ?>/vue/login.php">Se connecter</a>
                <a href="<?php echo BASE_URL; ?>/vue/register.php">S'inscrire</a>
            <?php else: ?>
                <!-- Redirection vers le bon tableau de bord selon le rôle de l'utilisateur -->
                <a href="<?php
                    if ($userRole === 'student') {
                        echo 'eleve/dashboard.php';
                    } elseif ($userRole === 'teacher') {
                        echo 'professeur/dashboard.php';
                    } elseif ($userRole === 'parent') {
                        echo 'parent/dashboard.php';
                    } elseif ($userRole === 'admin') {
                        echo 'admin/dashboard.php';
                    }
                ?>">Tableau de bord</a>
            <?php endif; ?>
        </nav>

        <nav class="desktop-nav">
            <a href="<?php echo BASE_URL; ?>/vue/index.php">Accueil</a>
            <?php if (!$isLoggedIn): ?>
                <a href="<?php echo BASE_URL; ?>/vue/login.php">Se connecter</a>
                <a href="<?php echo BASE_URL; ?>/vue/register.php">S'inscrire</a>
            <?php else: ?>
                <!-- Redirection vers le bon tableau de bord selon le rôle de l'utilisateur -->
                <a href="<?php
                    if ($userRole === 'student') {
                        echo BASE_URL . '/vue/eleve/dashboard.php';
                    } elseif ($userRole === 'teacher') {
                        echo BASE_URL . '/vue/professeur/dashboard.php';
                    } elseif ($userRole === 'parent') {
                        echo BASE_URL . '/vue/parent/dashboard.php';
                    } elseif ($userRole === 'admin') {
                        echo BASE_URL . '/vue/admin/dashboard.php';
                    }
                ?>">Tableau de bord</a>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>
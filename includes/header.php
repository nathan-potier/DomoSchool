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
    <script src="<?php echo BASE_URL; ?>/assets/js/header.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    

</head>
<body class="hidden-content">
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

    <!-- Logo -->
    <div class="logo">
        <a href="<?php echo BASE_URL; ?>/accueil">
            <img class="header-content" src="<?php echo BASE_URL; ?>/assets/images/logo-sans-bg2.png" alt="Logo">
        </a>
    </div>

    <!-- Menu Burger pour mobile -->
    <div class="boutonBurger">
        <span class="span1"></span>
        <span class="span2"></span>
        <span class="span3"></span>
    </div>

    <!-- Menu pour mobile -->
    <nav class="menuBurger">
        <a href="<?php echo BASE_URL; ?>/accueil">Accueil</a>
        <a href="<?php echo BASE_URL; ?>/accueil#about">À propos</a>
        <a href="<?php echo BASE_URL; ?>/courses">Cours</a>

        <?php if (!$isLoggedIn): ?>
            <a href="<?php echo BASE_URL; ?>/login">Se connecter</a>
            <a href="<?php echo BASE_URL; ?>/register">S'inscrire</a>
        <?php else: ?>
            <a href="<?php
                if ($userRole === 'student') {
                    echo BASE_URL . '/eleve/dashboard';
                } elseif ($userRole === 'teacher') {
                    echo BASE_URL . '/professeur/dashboard';
                } elseif ($userRole === 'parent') {
                    echo BASE_URL . '/parent/dashboard';
                } elseif ($userRole === 'admin') {
                    echo BASE_URL . '/admin/dashboard';
                }
            ?>">Tableau de bord</a>
        <?php endif; ?>
    </nav>


    <!-- Menu pour ordinateur -->
    <nav class="desktop-nav">
        <a href="<?php echo BASE_URL; ?>/accueil">Accueil</a>
        <a href="<?php echo BASE_URL; ?>/accueil#about">À propos</a>
        <a href="<?php echo BASE_URL; ?>/courses">Cours</a>


        <?php if (!$isLoggedIn): ?>
            <a href="<?php echo BASE_URL; ?>/login">Se connecter</a>
            <a href="<?php echo BASE_URL; ?>/register">S'inscrire</a>
        <?php else: ?>
            <a href="<?php echo BASE_URL; ?>/BAC">BAC</a>
            <a href="<?php
                if ($userRole === 'student') {
                    echo BASE_URL . '/eleve/dashboard';
                } elseif ($userRole === 'teacher') {
                    echo BASE_URL . '/professeur/dashboard';
                } elseif ($userRole === 'parent') {
                    echo BASE_URL . '/parent/dashboard';
                } elseif ($userRole === 'admin') {
                    echo BASE_URL . '/admin/dashboard';
                }
            ?>">Tableau de bord</a>
        <?php endif; ?>
    </nav>

</header>

</body>
</html>

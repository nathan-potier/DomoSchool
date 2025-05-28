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


    

    <meta name="description" content="Domoschool est une plateforme éducative dédiée à la spécialité NSI, avec des cours clairs, des exercices corrigés et un suivi de progression.">
    <meta name="keywords" content="domoschool, NSI, bac NSI, cours NSI, informatique lycée, python, html, php, exercices corrigés">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Domoschool">

    <!-- Open Graph pour le partage sur réseaux sociaux -->
    <meta property="og:title" content="Domoschool - Cours et exercices pour NSI">
    <meta property="og:description" content="Cours, exercices et suivi en ligne pour réussir la spécialité NSI. Terminale et Première.">
    <meta property="og:url" content="https://domoschool.com">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://domoschool.com/assets/images/logo.png"> <!-- Remplace par ton logo/image -->


    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Domoschool",
        "url": "https://domoschool.com",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://domoschool.com/recherche?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
        }
    </script>

    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Domoschool",
        "url": "https://domoschool.com",
        "logo": "https://domoschool.com/assets/logo.png", 
        "sameAs": [
            "https://www.facebook.com/domoschool",
            "https://www.instagram.com/domoschool",
            "https://www.linkedin.com/company/domoschool"
        ]
        }
    </script>

    <!-- Favicon (facultatif mais conseillé) -->
    <link rel="icon" href="<?php echo BASE_URL; ?>/assets/images" type="image/x-icon">



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/variables.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/burger-menu.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/forms.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/notifications.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/cards.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/signup.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/dark-mode.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/courses.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/purchase.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/homepage.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/topics.css">



    
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

   <div id="menu">
        <div id="menu-bar" onclick="menuOnClick()">
            <div id="bar1" class="bar"></div>
            <div id="bar2" class="bar"></div>
            <div id="bar3" class="bar"></div>
        </div>

        <nav class="nav" id="nav">
            <ul>
            <li><a href="<?php echo BASE_URL; ?>/accueil">Accueil</a></li>
            <li><a href="<?php echo BASE_URL; ?>/accueil#about">À propos</a></li>
            

            <?php if (!$isLoggedIn): ?>
                <li><a href="<?php echo BASE_URL; ?>/courses">Cours</a></li>
                <li><a href="<?php echo BASE_URL; ?>/login">Se connecter</a></li>
                <li><a href="<?php echo BASE_URL; ?>/register">S'inscrire</a></li>
            <?php else: ?>
                
                <li><a href="<?php
                    if ($userRole === 'student') {
                        echo BASE_URL . '/eleve/dashboard';
                    } elseif ($userRole === 'teacher') {
                        echo BASE_URL . '/professeur/dashboard';
                    } elseif ($userRole === 'parent') {
                        echo BASE_URL . '/parent/dashboard';
                    } elseif ($userRole === 'admin') {
                        echo BASE_URL . '/admin/dashboard';
                    }
                ?>">Tableau de bord</a></li>
                <li><a href="<?php echo BASE_URL; ?>/exercices">Exercices</a></li>
                <li><a href="<?php echo BASE_URL; ?>/courses">Cours</a></li>
            <?php endif; ?>
            </ul>
        </nav>
    </div>

    <div class="menu-bg" id="menu-bg"></div>



    <!-- Menu pour ordinateur -->
    <nav class="desktop-nav">
        <a href="<?php echo BASE_URL; ?>/accueil">Accueil</a>
        <a href="<?php echo BASE_URL; ?>/accueil#about">À propos</a>
        <a href="<?php echo BASE_URL; ?>/courses">Cours</a>


        <?php if (!$isLoggedIn): ?>
            <a href="<?php echo BASE_URL; ?>/login">Se connecter</a>
            <a href="<?php echo BASE_URL; ?>/register">S'inscrire</a>
        <?php else: ?>
            <a href="<?php echo BASE_URL; ?>/exercices">Exercices</a>
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

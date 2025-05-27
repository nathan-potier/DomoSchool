<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();
?>

<?php include('../../includes/header.php'); ?>

<div class="container legal-container">
    <h1>Politique de Cookies</h1>

    <section>
        <p>Notre site <strong>DomoSchool</strong> utilise des cookies pour améliorer votre expérience utilisateur, analyser le trafic et personnaliser le contenu. Cette politique vous explique quels cookies nous utilisons, pourquoi, et comment vous pouvez gérer vos préférences.</p>
    </section>

    <section>
        <h2>1. Qu’est-ce qu’un cookie ?</h2>
        <p>Un cookie est un petit fichier texte placé sur votre appareil par un site web. Il permet au site de reconnaître votre navigateur et de mémoriser certaines informations (préférences, sessions, etc.).</p>
    </section>

    <section>
        <h2>2. Quels types de cookies utilisons-nous ?</h2>
        <ul>
            <li>
                <strong>Cookies essentiels :</strong> Ces cookies sont indispensables au bon fonctionnement du site. Ils permettent par exemple de maintenir une session utilisateur active (comme le cookie <code>PHPSESSID</code>). Ils ne nécessitent pas votre consentement.
            </li>
            <li>
                <strong>Cookies de performance :</strong> <em>(actuellement non utilisés)</em> Ces cookies servent à analyser la fréquentation du site (par exemple via Google Analytics) afin d’améliorer son ergonomie et ses contenus.
            </li>
            <li>
                <strong>Cookies fonctionnels :</strong> <em>(actuellement non utilisés)</em> Ces cookies permettent de mémoriser vos préférences (langue, thème, etc.) pour améliorer votre expérience utilisateur.
            </li>
            <li>
                <strong>Cookies publicitaires :</strong> <em>(actuellement non utilisés)</em> Ces cookies sont utilisés pour afficher des publicités personnalisées en fonction de votre navigation.
            </li>
        </ul>
    </section>


    <section>
        <h2>3. Gestion des cookies</h2>
        <p>Vous pouvez accepter, refuser ou supprimer les cookies en configurant les paramètres de votre navigateur. Voici des liens utiles pour gérer vos cookies :</p>
        <ul>
            <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener noreferrer">Gérer les cookies dans Google Chrome</a></li>
            <li><a href="https://support.mozilla.org/fr/kb/cookies-informations-sites-enregistrent" target="_blank" rel="noopener noreferrer">Gérer les cookies dans Firefox</a></li>
            <li><a href="https://support.microsoft.com/fr-fr/windows/supprimer-les-cookies-dans-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener noreferrer">Gérer les cookies dans Microsoft Edge</a></li>
            <li><a href="https://support.apple.com/fr-fr/guide/safari/sfri11471/mac" target="_blank" rel="noopener noreferrer">Gérer les cookies dans Safari</a></li>
        </ul>
    </section>

    <section>
        <h2>4. Consentement</h2>
        <p>Lors de votre première visite, vous êtes invité à accepter les cookies via une bannière. Vous pouvez modifier votre choix à tout moment depuis cette bannière ou via les paramètres de votre navigateur.</p>
    </section>

    <section>
        <h2>5. Plus d’informations</h2>
        <p>Pour en savoir plus sur notre <a href="<?php echo BASE_URL; ?>politique-de-confidentialite">Politique de Confidentialité</a> ou nos <a href="<?php echo BASE_URL; ?>conditions-generales">Conditions Générales d’Utilisation</a>, cliquez sur les liens correspondants.</p>
    </section>



    <p><em>Dernière mise à jour : 27 mai 2025</em></p>

</div>

<?php include('../../includes/footer.php'); ?>

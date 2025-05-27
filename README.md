
# DomoSchool

DomoSchool est une plateforme d'éducation en ligne qui combine des **cours particuliers en visioconférence**, des **exercices interactifs en autonomie** et un **suivi en temps réel pour les parents**. Le but est d'offrir une solution complète, personnalisée et accessible pour la réussite scolaire des élèves.

## 🌟 Objectifs

- Offrir un accompagnement scolaire de qualité, sur mesure.
- Permettre aux élèves de progresser à leur rythme.
- Donner aux parents une vision claire et détaillée des progrès de leur enfant.
- Fournir aux professeurs un espace de gestion pédagogique efficace.

## 🛆 Fonctionnalités Clés

### 👨‍🎓 Élève
- Espace de travail personnalisé.
- Modules de cours et exercices interactifs.
- Parcours pédagogique adapté.
- Cours particuliers en visioconférence.
- Relecture des sessions enregistrées.

### 👩‍🏫 Professeur
- Création de contenus pédagogiques.
- Suivi des progrès des élèves.
- Planification des cours particuliers.
- Messagerie avec les parents et les élèves.

### 👪 Parent
- Tableau de bord avec visualisation des progrès.
- Historique des cours et des sessions.
- Rapports détaillés avec recommandations.

## 🛠 Technologies utilisées

- HTML / CSS / JavaScript (Frontend)
- PHP (Backend)
- (Prévu) Base de données MySQL
- (Prévu) Intégration de services de visio (ex: Zoom, Jitsi)

## 🗂 Structure du projet

```
domoschool/
|   .htaccess
|   README.md
|   table.sql
|
+---.dist
+---assets
|   +---css
|   |       all1one(old).css
|   |       burger-menu.css
|   |       cards.css
|   |       courses.css
|   |       dark-mode.css
|   |       dashboard.css
|   |       footer.css
|   |       forms.css
|   |       global.css
|   |       header.css
|   |       homepage.css
|   |       notifications.css
|   |       purchase.css
|   |       reset.css
|   |       responsive.css
|   |       signup.css
|   |       topics.css
|   |       variables.css
|   |
|   +---images
|   |       Acceuil.png
|   |       logo-sans-bg-blanc.png
|   |       logo-sans-bg-claire.png
|   |       logo-sans-bg-noir.png
|   |       logo-sans-bg.png
|   |       logo-sans-bg2.png
|   |       logo.png
|   |       photo-nathan.jpg
|   |
|   \---js
|           header.js
|           listener_time.js
|           main.js
|           menuBurger.js
|           notif.js
|
+---config
|       config.php
|
+---includes
|   |   db.php
|   |   footer.php
|   |   functions.php
|   |   header.php
|   |   notif.php
|   |
|   \---footer
|           cgu.php
|           contact.php
|           cookies.php
|           faq.php
|           mentions-legales.php
|           politique-de-confidentialite.php
|
+---logs
|       activity.log
|       database.log
|       errors.log
|       php_errors.log
|       
+---models
|       authenticate.php
|       check_code.php
|       get_courses.php
|       get_exercises.php
|       get_user_data.php
|       logout.php
|       register_user.php
|       update_profile.php
|
+---uploads
|   +---courses
|   |       course_67f9a52c31cd2.html
|   |       course_67f9a573da7df.html
|   |       course_67fade20e682c.html
|   |       course_67fb832410f90.html
|   |
|   \---exercices
|           exercise_6835a6840bd46.html
|
\---vue
    |   index.php
    |   view_course.php
    |   view_exercice.php
    |
    +---admin
    |       courses.php
    |       dashboard.php
    |       logs.php
    |       settings.php
    |       users.php
    |
    +---auth
    |       login.php
    |       register.php
    |
    +---eleve
    |       courses.php
    |       dashboard.php
    |       exercices.php
    |       profile.php
    |       schedule.php
    |
    +---parent
    |       child.php
    |       dashboard.php
    |       messages.php
    |       profile.php
    |
    +---professeur
    |       create-course.php
    |       create-exercise.php
    |       dashboard.php
    |       messages.php
    |       profile.php
    |       students.php
    |
    \---purchase
            checkout.php
            purchase_code.php
            purchase_success.php

```

## 🚀 Roadmap

### Phase 1 - MVP
- Espace élève de base
- Connexion utilisateur
- Tableaux de bord simplifiés
- Sessions de cours en visio

### Phase 2 - Personnalisation et Algorithmes
- Adaptation automatique du contenu selon les performances
- Création de nouveaux modules
- Interface avancée professeur

### Phase 3 - Mobile & IA
- Application mobile
- Gamification (badges, défis)
- IA pour recommandations et corrections automatiques

## 🤝 Contribuer

Tu veux participer au projet ? Contacte-moi ou crée une pull request !

## 📧 Contact

Développé par [Nathan Potier](https://github.com/nathan-potier)

---

**DomoSchool** — Le soutien scolaire nouvelle génération 🇫🇷


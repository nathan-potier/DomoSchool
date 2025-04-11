
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
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── images/
│   │   └── logo.png
│   └── js/
│       ├── main.js
│       └── menuBurger.js
├── config/
│   └── config.php
├── includes/
│   ├── db.php                → Connexion à la base de données
│   ├── footer.php            → Pied de page
│   ├── functions.php         → Fonctions générales (validation, gestion erreurs)
│   ├── header.php            → En-tête global (menu, etc.)
│   └── notif.php             → Gestion des notifications
├── logs/
│   ├── activity.log
│   └── errors.log
├── models/
│   ├── authenticate.php      → Vérification de connexion et inscription
│   ├── logout.php            → Déconnexion utilisateur
│   ├── register_user.php     → Inscription des utilisateurs
│   ├── get_user_data.php     → Récupération des informations utilisateurs
│   ├── get_courses.php       → Récupération des cours
│   ├── get_exercises.php     → Récupération des exercices
│   └── update_profile.php    → Mise à jour du profil utilisateur
├── uploads/
│   └── courses/
│       └── [fichiers uploadés ici]
├── vue/
│   ├── eleve/
│   │   ├── dashboard.php     → Tableau de bord de l’élève
│   │   ├── courses.php       → Liste des cours de l’élève
│   │   ├── profile.php       → Modification du profil de l’élève
│   │   ├── exercises.php     → Liste des exercices interactifs
│   │   └── schedule.php      → Planification des cours
│   ├── parent/
│   │   ├── dashboard.php     → Tableau de bord du parent
│   │   ├── child.php         → Suivi d’un enfant spécifique
│   │   ├── profile.php       → Modification du profil du parent
│   │   └── messages.php      → Messagerie avec les professeurs
│   ├── professeur/
│   │   ├── dashboard.php     → Tableau de bord du professeur
│   │   ├── create-course.php → Création de nouveaux cours
│   │   ├── create-exercise.php → Création d’exercices
│   │   ├── students.php      → Liste des élèves suivis
│   │   ├── messages.php      → Messagerie interne
│   │   └── profile.php       → Modification du profil du professeur
│   ├── admin/
│   │   ├── dashboard.php     → Vue d’ensemble de l’administration
│   │   ├── users.php         → Gestion des utilisateurs
│   │   ├── courses.php       → Validation des cours créés
│   │   ├── logs.php          → Logs d’activité
│   │   └── settings.php      → Paramètres généraux du site
│   ├── login.php             → Page de connexion
│   ├── register.php          → Page d'inscription
│   ├── index.php             → Page d'accueil publique
│   └── view_course.php
├── README.md
└── table.sql                 → Commandes pour creer les tables 
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


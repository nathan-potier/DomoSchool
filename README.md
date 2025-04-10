
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
DomoSchool/
├── index.php                // Page d'accueil
├── login.php                // Connexion utilisateur
├── register.php             // Inscription utilisateur
├── register_user.php        // Traitement de l'inscription (enregistrement en base de données)
├── dashboard.php            // Tableau de bord principal
├── student-dashboard.php    // Tableau de bord élève
├── parent-dashboard.php     // Tableau de bord parent
├── teacher-dashboard.php    // Tableau de bord professeur
├── assets/
│   ├── css/
│   │   └── style.css        // Fichier CSS principal
│   └── js/
│       └── main.js          // Fichier JS principal
├── includes/
│   ├── header.php           // En-tête commun à toutes les pages
│   ├── footer.php           // Pied de page commun à toutes les pages
│   └── db.php               // Fichier de connexion à la base de données (PDO ou MySQLi)
├── config/
│   └── config.php           // Fichier de configuration global (ex: paramètres de base de données, sécurité)
├── uploads/                 // Dossier pour les fichiers téléchargés par les utilisateurs (par exemple, avatars, documents)
├── logs/                    // Dossier pour les fichiers de logs du serveur
├── .htaccess                // Fichier de configuration Apache pour la gestion des routes et la sécurité
└── README.md                // Documentation du projet

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


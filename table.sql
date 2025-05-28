CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher', 'admin', 'parent') DEFAULT 'student',
    last_login TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    teacher_id INT NOT NULL, -- L'enseignant est directement référencé par son id dans la table 'users'
    file_path VARCHAR(255),  -- Option pour le fichier du cours (lien vers un fichier exporté par exemple)
    chapter_id INT,         -- Option pour lier le cours à un chapitre si tu veux organiser les cours par chapitre
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE, -- Référence à l'enseignant dans la table 'users'
    FOREIGN KEY (chapter_id) REFERENCES chapters(id) ON DELETE SET NULL -- Référence au chapitre, option pour gérer la suppression
);

CREATE TABLE chapters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);




-- Table des exercices génériques créés par les profs
CREATE TABLE exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    language VARCHAR(50) DEFAULT 'python',
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);






CREATE TABLE user_course_completion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    completed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    time_spent_minutes INT NOT NULL, -- Temps passé sur le cours en minutes
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_course (user_id, course_id) -- Empêche les doublons
);

CREATE TABLE user_exercise_completion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    exercise_id INT NOT NULL,
    completed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    attempts INT DEFAULT 1, -- Nombre de tentatives
    time_spent_minutes INT NOT NULL, -- Temps passé sur l'exercice en minutes
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (exercise_id) REFERENCES exercises(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_exercise (user_id, exercise_id) -- Empêche les doublons
);

CREATE TABLE user_learning_stats (
    user_id INT PRIMARY KEY,
    total_courses_read INT DEFAULT 0,
    total_exercises_completed INT DEFAULT 0,
    total_time_spent_minutes INT DEFAULT 0, -- Temps total en minutes
    overall_progress TINYINT DEFAULT 0, -- Progression en pourcentage (0-100)
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);








CREATE TABLE student_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    total_courses_read INT DEFAULT 0,
    total_exercises_completed INT DEFAULT 0,
    progress_percent TINYINT DEFAULT 0, -- Progression globale en pourcentage
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY (student_id) -- Un seul enregistrement par élève
);



CREATE TABLE access_codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(32) NOT NULL UNIQUE,
    role ENUM('student', 'teacher', 'admin', 'parent') NOT NULL,
    used BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    used_at TIMESTAMP NULL DEFAULT NULL
);




CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);


INSERT INTO access_codes (code, role, used) VALUES ('CODETEACHER456', 'teacher', FALSE);

INSERT INTO access_codes (code, role, used) VALUES
('CODESTUDENT123', 'student', FALSE),
('CODETEACHER456', 'teacher', FALSE),
('CODEADMIN789', 'admin', FALSE),
('CODEPARENT321', 'parent', FALSE);



INSERT INTO chapters (name, description) VALUES

('Algorithmique et programmation en Python',
 'Notions principales : variables, types, structures conditionnelles, boucles, fonctions, récursivité. Apprentissage du langage Python pour résoudre des problèmes algorithmiques.'),

('Structures de données',
 'Étude des structures fondamentales : listes, piles, files, dictionnaires, arbres (arbres binaires, parcours infixe, préfixe, postfixe), graphes (représentation, parcours DFS, BFS).'),

('Programmation orientée objet (POO)',
 'Concepts clés : classes, objets, attributs, méthodes, encapsulation, héritage, polymorphisme. Mise en œuvre en Python pour créer des programmes modulaires et évolutifs.'),

('Bases du web : HTML, CSS, JavaScript',
 'Création et structuration des pages web avec HTML, mise en forme avec CSS, programmation événementielle et manipulation du DOM avec JavaScript.'),

('Bases de données et SQL',
 'Création et gestion de bases de données relationnelles. Requêtes SQL : SELECT, INSERT, UPDATE, DELETE, jointures, contraintes d\'intégrité.'),

('Systèmes et réseaux',
 'Introduction aux systèmes d\'exploitation : gestion des processus, mémoire, fichiers. Notions de réseaux informatiques : modèles OSI et TCP/IP, protocoles, adressage IP, sécurité.'),

('Intelligence artificielle et apprentissage automatique',
 'Principes de base de l\'intelligence artificielle : algorithmes de recherche, apprentissage supervisé, réseaux de neurones simples, classification.'),

('Programmation fonctionnelle et récursion avancée',
 'Approfondissement des concepts fonctionnels : fonctions d\'ordre supérieur, immutabilité, récursion, structures récursives comme les arbres.'),

('Algorithmique avancée',
 'Étude d\'algorithmes complexes : tris (tri par insertion, fusion, rapide), recherche, complexité algorithmique (notation Big O), algorithmes gloutons, programmation dynamique.'),

('Projet tutoré',
 'Mise en œuvre pratique de toutes les compétences acquises à travers la conception et le développement d\'un projet complet, intégrant programmation, algorithmique et travail collaboratif.')
;

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

INSERT INTO chapters (name, description) VALUES
('Algorithmique et programmation', 'Étudier les bases de l\'algorithmique, les structures de données, les algorithmes de tri et de recherche, et la programmation en Python.'),
('Structures de données', 'Les listes, tableaux, dictionnaires, piles, files, arbres, graphes et leurs applications en algorithmique.'),
('Programmation orientée objet', 'Les concepts de la programmation orientée objet, avec une mise en pratique en Python ou en Java.'),
('Bases de données', 'Étudier les modèles de bases de données relationnelles et le langage SQL pour manipuler les données.'),
('Architecture des ordinateurs', 'Comprendre l\'architecture d\'un ordinateur, les mémoires, les processeurs et les périphériques.'),
('Réseaux', 'Les bases des réseaux informatiques : protocoles, topologies, TCP/IP, communication, Internet et sécurité des réseaux.'),
('Sécurité informatique', 'Les principes de la sécurité des systèmes d\'information, cryptographie, sécurité des réseaux et gestion des risques.'),
('Interfaces utilisateur', 'Les interfaces homme-machine : conception et interaction utilisateur, ergonomie des interfaces, développement d\'applications graphiques.'),
('Machine Learning et Intelligence Artificielle', 'Introduction aux concepts de machine learning, réseaux neuronaux et applications de l\'IA dans les systèmes informatiques.');




-- Table des exercices génériques créés par les profs
CREATE TABLE exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    language VARCHAR(50) DEFAULT 'python',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des exercices réalisés par les élèves
CREATE TABLE student_exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    exercise_id INT NOT NULL,
    filename VARCHAR(255),
    code TEXT, -- le contenu du fichier ici
    language VARCHAR(50) DEFAULT 'python', -- redondance utile si l'élève choisit un autre langage
    completed BOOLEAN DEFAULT FALSE,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (exercise_id) REFERENCES exercises(id) ON DELETE CASCADE
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



-- Table des sujets de révision pour le bac NSI
CREATE TABLE revision_topics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    chapter_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (chapter_id) REFERENCES chapters(id) ON DELETE SET NULL
);

-- Table des sous-sujets de révision
CREATE TABLE revision_subtopics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    topic_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (topic_id) REFERENCES revision_topics(id) ON DELETE CASCADE
);

-- Table pour suivre les révisions des élèves
CREATE TABLE student_revisions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subtopic_id INT NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    last_reviewed TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (subtopic_id) REFERENCES revision_subtopics(id) ON DELETE CASCADE
);


-- Insertion de sujets de révision
INSERT INTO revision_topics (title, description, chapter_id) VALUES
('Algorithmes et Programmation', 'Étudier les bases de la programmation et des algorithmes.', 1),
('Architecture des Machines', 'Comprendre les composants d\'un ordinateur et les systèmes d\'exploitation.', 2),
('Réseaux', 'Apprendre les protocoles réseau et la sécurité des réseaux.', 3),
('Bases de Données', 'Étudier les modèles de bases de données et le langage SQL.', 4);

-- Insertion de sous-sujets de révision
INSERT INTO revision_subtopics (topic_id, title, description) VALUES
(1, 'Les bases de la programmation', 'Variables, boucles, conditions'),
(1, 'Les structures de données', 'Listes, piles, files'),
(2, 'Les composants d\'un ordinateur', 'CPU, RAM, disque dur'),
(2, 'Les systèmes d\'exploitation', 'Fonctions et gestion des processus'),
(3, 'Les protocoles réseau', 'TCP/IP, HTTP, FTP'),
(3, 'La sécurité des réseaux', 'Firewalls, VPN, cryptographie'),
(4, 'Les modèles de données', 'Modèle relationnel, SQL'),
(4, 'Les requêtes SQL', 'SELECT, INSERT, UPDATE, DELETE');











CREATE TABLE schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    date DATETIME NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key VARCHAR(255) NOT NULL UNIQUE,
    value TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

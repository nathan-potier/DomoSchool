<?php
$host = 'localhost';
$dbname = 'domoschool'; // à adapter
$username = 'root';     // à adapter (par défaut sur XAMPP)
$password = '';         // à adapter (par défaut sur XAMPP)

// Créer une connexion MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    error_log("Erreur MySQLi : " . $conn->connect_error);
    die("Impossible de se connecter à la base de données.");
}
?>

<?php
// Connexion à la base MySQL avec PDO (à inclure en haut de chaque page)
$hote = 'localhost';
$base = 'album_photo';
$utilisateur = 'root';
$mot_de_passe = ''; // vide par défaut sur WAMP

try {
    $pdo = new PDO("mysql:host=$hote;dbname=$base;charset=utf8mb4", $utilisateur, $mot_de_passe);
    // Affiche les erreurs SQL sous forme d'exceptions (pratique pendant le développement)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Les résultats sont renvoyés sous forme de tableaux associatifs : $ligne['titre']
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erreur de connexion à la base : ' . $e->getMessage());
}

// Démarre la session pour savoir qui est connecté
session_start();

// Petites fonctions utiles partout
function est_connecte() {
    return isset($_SESSION['id_utilisateur']);
}

function est_admin() {
    return !empty($_SESSION['est_admin']);
}

// Protège l'affichage contre le XSS : à utiliser pour tout texte venant de la base ou d'un formulaire
function e($texte) {
    return htmlspecialchars($texte ?? '', ENT_QUOTES, 'UTF-8');
}

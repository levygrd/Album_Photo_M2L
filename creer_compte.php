<?php
// Outil pour créer les comptes (admin ou utilisateur).
// À utiliser en local uniquement, puis à SUPPRIMER avant de rendre le projet.
require 'includes/connexion.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $requete = $pdo->prepare('INSERT INTO Utilisateur (login, mdp_hash, est_admin) VALUES (?, ?, ?)');
    $requete->execute([$_POST['login'], $hash, isset($_POST['admin']) ? 1 : 0]);
    $message = 'Compte créé : ' . e($_POST['login']);
}
?>
<!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><title>Créer un compte</title></head>
<body>
<h2>Créer un compte</h2>
<p><?= $message ?></p>
<form method="post">
    <label>Login <input name="login" required></label><br>
    <label>Mot de passe <input type="password" name="mdp" required></label><br>
    <label><input type="checkbox" name="admin"> Administrateur</label><br>
    <button type="submit">Créer</button>
</form>
</body></html>

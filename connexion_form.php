<?php
require 'includes/connexion.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Requête préparée : protège contre l'injection SQL
    $requete = $pdo->prepare('SELECT * FROM Utilisateur WHERE login = ?');
    $requete->execute([$_POST['login'] ?? '']);
    $utilisateur = $requete->fetch();

    // password_verify compare le mot de passe tapé avec le hachage stocké
    if ($utilisateur && password_verify($_POST['mdp'] ?? '', $utilisateur['mdp_hash'])) {
        session_regenerate_id(true); // évite le vol de session
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['login'] = $utilisateur['login'];
        $_SESSION['est_admin'] = (bool) $utilisateur['est_admin'];
        header('Location: index.php');
        exit;
    }
    $erreur = 'Login ou mot de passe incorrect.';
}

require 'includes/header.php';
?>
<h2>Connexion</h2>
<?php if ($erreur): ?><p class="erreur"><?= e($erreur) ?></p><?php endif; ?>
<form method="post">
    <label>Login <input type="text" name="login" required></label>
    <label>Mot de passe <input type="password" name="mdp" required></label>
    <button type="submit">Se connecter</button>
</form>
<?php require 'includes/footer.php'; ?>

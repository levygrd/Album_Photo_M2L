<?php
// En-tête commun : menu des pages de l'album + lien connexion / déconnexion
$pages = $pdo->query('SELECT id_page, titre FROM Page ORDER BY ordre')->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Album photo M2L</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1><a href="index.php">Album photo M2L</a></h1>
    <nav>
        <?php foreach ($pages as $p): ?>
            <a href="index.php?page=<?= $p['id_page'] ?>"><?= e($p['titre']) ?></a>
        <?php endforeach; ?>
    </nav>
    <div class="compte">
        <?php if (est_connecte()): ?>
            Connecté : <?= e($_SESSION['login']) ?><?= est_admin() ? ' (admin)' : '' ?>
            <a href="deconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion_form.php">Connexion</a>
        <?php endif; ?>
    </div>
</header>
<main>

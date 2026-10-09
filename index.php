<?php
require 'includes/connexion.php';
require 'includes/header.php';

// Page demandée dans l'URL (index.php?page=2), sinon la première page
$id_page = isset($_GET['page']) ? (int) $_GET['page'] : ($pages[0]['id_page'] ?? 0);
?>

<!-- TODO (personne A) : afficher ici les photos de la page $id_page avec leur légende -->
<p>Page sélectionnée : <?= $id_page ?></p>

<?php require 'includes/footer.php'; ?>

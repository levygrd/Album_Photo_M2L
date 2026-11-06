<?php
require 'includes/connexion.php';
require 'includes/header.php';

// Page demandée dans l'URL (index.php?page=2), sinon la première page
$id_page = isset($_GET['page']) ? (int) $_GET['page'] : ($pages[0]['id_page'] ?? 0);

// Le public ne voit que les photos non supprimées ; l'admin voit tout
$sql = 'SELECT id_photo, chemin_fichier, legende, date_suppression FROM Photo WHERE id_page = ?';
if (!est_admin()) {
    $sql .= ' AND date_suppression IS NULL';
}
$sql .= ' ORDER BY date_ajout DESC';

$requete = $pdo->prepare($sql);
$requete->execute([$id_page]);
$photos = $requete->fetchAll();
?>

<div class="galerie">
    <?php foreach ($photos as $photo): ?>
        <figure class="<?= $photo['date_suppression'] ? 'en-suppression' : '' ?>">
            <a href="photo.php?id=<?= $photo['id_photo'] ?>">
                <img src="uploads/<?= e($photo['chemin_fichier']) ?>" alt="<?= e($photo['legende']) ?>">
            </a>
            <figcaption>
                <?= e($photo['legende']) ?>
                <?php if ($photo['date_suppression']): ?>
                    <strong>En cours de suppression</strong>
                <?php endif; ?>
            </figcaption>
        </figure>
    <?php endforeach; ?>
</div>

<?php if (!$photos): ?>
    <p>Aucune photo sur cette page pour le moment.</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>

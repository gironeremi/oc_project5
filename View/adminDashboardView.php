<?php $title = 'Panneau Administrateur'; ?>
<?php ob_start(); ?>

<h1>Salut, chef!</h1>
<ul class="list-group">Liste des jeux de rôle disponibles:</ul>
<?php
foreach ($games as $game) {
    ?>
    <li class="list-group-item">
        <h3><?= $game['gameName']?></h3>
        <h4><?= $game['style'] ?></h4>
        <div>
            <a href="index.php?action=getGameEditor&game_id=<?= $game['game_id'] ?>" class="btn btn-secondary m-2">Modifier</a>
            <a href="index.php?action=deleteGame&game_id=<?= $game['game_id'] ?>" class="btn btn-danger m-2">Supprimer</a>
        </div>
    </li>
<?php
}
?>

<?php $content = ob_get_clean();
require('template.php'); ?>

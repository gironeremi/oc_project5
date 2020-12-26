<?php $title = 'Panneau Administrateur'; ?>
<?php ob_start(); ?>
<div class="jumbotron">
<h1>Bienvenue, cher Administrateur!</h1>
</div>
<h2 class="m-3">Liste des jeux de rôle disponibles:</h2>
<?php
foreach ($games as $game) {
    ?>
    <!--<div class="card m-5">
        <h3><?= $game['gameName']; ?></h3>
        <img src="/public/images/<?= $game['picture']; ?>" class="img-thumbnail"/>
        <h4><?= $game['style']; ?></h4>-->
    <div class="card m-3 img-fluid shadow-lg" style="max-width: 800px">
        <img src="/public/images/<?= $game['picture']; ?>" class="card-img-top" alt="<?= $game['gameName']; ?>"/>
        <div class="card-img-overlay">
            <div class="card-title"><h2><span class="badge badge-primary"><?= $game['gameName']; ?></span></h2></div>
            <div class="card-text text-white"><h5 class="font-weight-bold"><?= $game['style']; ?></h5></div>
            <div>
                <a href="index.php?action=getGameEditor&game_id=<?= $game['game_id']; ?>" class="btn btn-secondary m-2">Modifier</a>
                <a href="index.php?action=deleteGame&game_id=<?= $game['game_id']; ?>" class="btn btn-danger m-2">Supprimer</a>
            </div>
        </div>
    </div>

    <!--</div>-->
<?php
}
?>

<?php $content = ob_get_clean();
require('template.php'); ?>

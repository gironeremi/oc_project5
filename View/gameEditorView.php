<?php $title = 'Éditeur de jeu'; ?>
<?php ob_start(); ?>
<?php
if (!empty($errors)) { ?>
    <div class="alert alert-danger col-md-8 m-3 p-3 shadow-sm">
        <p>Soucis lors de la saisie des informations: </p>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?= $error; ?></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}
?>
    <form class="m-3 p-3 shadow" method="post" enctype="multipart/form-data" <?php
    if (!empty($game)) {?>
        action="index.php?action=updateGame&game_id=<?= $game['game_id'] ?>"
    <?php
    } else {
    ?>
        action="index.php?action=addGame"
    <?php
    }
    ?>
    >
    <div class="form-group row p-2">
        <label for="gameName" class="col-4 col-form-label">Nom du jeu</label>
        <div class="col-8">
            <input id="gameName" name="gameName" placeholder="écrire ici" type="text" class="form-control" aria-describedby="gameNameHelpBlock" maxlength="255" required="required" value="<?php if(!empty($game['gameName'])) {echo $game['gameName'];} ?>">
            <span id="gameNameHelpBlock" class="form-text text-muted">N'oubliez pas les majuscules!</span>
        </div>
    </div>
    <div class="form-group row p-2">
        <label for="style" class="col-4 col-form-label">Un court descriptif du jeu</label>
        <div class="col-8">
            <input id="style" name="style" placeholder="écrire ici aussi" type="text" class="form-control" aria-describedby="styleHelpBlock" maxlength="255" required="required" value="<?php if(!empty($game['style'])) {echo $game['style'];} ?>">
            <span id="styleHelpBlock" class="form-text text-muted">style de jeu, nature de l'univers, etc.</span>
        </div>
    </div>
        <?php
        if (empty($game)) {
        ?>
        <div class="form-group row p-2">
            <div class="offset-4 col-8">
                <input type="file" name="fileToUpload" id="fileToUpload" <?php if(empty($game)){ echo 'required';} ?> >
                <span id="fileToUploadHelpBlock" class="form-text text-muted">Seulement des images, 500Ko maximum!</span>
            </div>
        </div>
        <?php
        }
        ?>
        <div class="form-group row p-2">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Ajouter à la liste de jeux</button>
            </div>
        </div>
</form>

<?php $content = ob_get_clean();
require('template.php'); ?>
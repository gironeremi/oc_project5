<?php $title = $event['eventName'];
ob_start(); ?>
<div class="card m-5 border-secondary shadow">
    <div class="card-header">
        <h2 class="card-title"><?= $event['eventName'] ?> - <small><?= $event['gameName']?></small></h2>
    </div>
    <div class="card-body">
        <h5 class="card-subtitle mb-2 text-muted">le <?= $event['eventDate_fr'] ?> <br />
            Organisé par <?= $event['username']?>
        </h5>
        <hr>
        <p class="card-text"><?= nl2br($event['informations']) ?></p>
    </div>
    <div class="card-footer d-flex flex-column justify-content-center align-items-center">
        <h5>Participants:</h5>
        <ul class="list-group col-md-8">
            <?php
            foreach ($players as $player) {
            ?>
            <li class="list-group-item"><?= $player ?></li>
            <?php
            }
            ?>
        </ul>
        <div class="mt-4 mb-2">
        <?php
        if (isset($_SESSION['username'])) {
            if ($_SESSION['username'] != $event['username']) {
                if (in_array($_SESSION['username'], $players) === true) {
                ?>
                    <a href="index.php?action=deletePlayer&event_id=<?=$event['event_id']?>" class="btn btn-lg btn-warning">Se retirer</a>
                <?php
                } else {
                ?>
                    <a href="index.php?action=addPlayer&event_id=<?=$event['event_id']?>" class="btn btn-primary btn-lg">Rejoindre cette table</a>
                <?php
                }
            }
        }
        ?>
        </div>
    </div>
</div>

<div class="card m-5 p-4 shadow bg-white rounded d-flex flex-column justify-content-center align-items-center">
    <?php
    if (isset($_SESSION['username'])) {
        ?>
        <form action="index.php?action=addComment&event_id=<?=$event['event_id']?>" method="post" class="form-group col-md-8">
            <div>
                <h2>Un commentaire?</h2>
                <label for="comment">Vous pouvez donner des informations importantes à votre groupe.<br />
                    <span class="text-info font-italic"> Ex: je serai en retard de 5 minutes, j'apporte une bouteille de soda, etc.</span>
                </label>
                <textarea id="comment" class="form-control mt-3 mb-4 shadow-sm" name="comment" placeholder="Saisissez ici votre commentaire" rows="3" maxlength="255" required></textarea>
            </div>
            <div class="mt-3 mb-2 d-flex justify-content-center align-items-center">
                <input type="submit" class="btn btn-primary btn-lg"/>
            </div>
        </form>
        <?php
    } else {
        echo '<div class="alert alert-info col-md-8 text-center"><strong><i class="fas fa-exclamation"></i> Attention: </strong>Pour laisser un commentaire, veuillez <a href="index.php?action=login">vous connecter.</a></div>';
    }
    ?>
</div>
<div class="card m-5 p-4 shadow bg-white rounded d-flex flex-column justify-content-center align-items-center">
    <h2 class="">Commentaires</h2>
    <?php
    if (count($comments) != 0) {
        foreach ($comments as $comment) {
            ?>
            <div class="card col-md-8 m-3 p-3 shadow-sm">
                <h4 class="card-title"><?= $comment['username'] ?> a dit:</h4>
                <p class="card-text"><?= nl2br($comment['comment']) ?></p>
                <p class="card-text font-italic text-muted">le <?= $comment['date_fr']?></p>
            </div>
            <?php
        }
    } else {
        echo 'Pas de commentaires.';
    }
        ?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
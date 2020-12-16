<?php $title = 'Tableau de bord';
ob_start(); ?>
<div class="jumbotron">
    <h1>Bienvenue <?= $_SESSION['username']; ?></h1>
    <p class=""></p>
</div>
<section>
    <h2>Prochaines séances organisées</h2>
    <?php
    if (!empty($events[0])) {
        foreach ($events as $event)
            {
                ?>
                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="card-title"><?= $event['eventName'] ?> - <?= $event['gameName']?></h2>
                        <h5 class="card-subtitle mb-2 text-muted">le <?= $event['eventDate_fr'] ?> <br />
                            Organisé par <?= $event['username']?>
                        </h5>
                    </div>
                    <!--<div class="card-body">
                        <p class="card-text"><?= $event['informations'] ?></p>
                    </div>-->
                    <div class="card-footer">
                        <a href="index.php?action=getEventById&event_id=<?= $event['event_id'] ?>" class="btn btn-primary m-2">Consulter</a>
                        <a href="index.php?action=getEventEditor&event_id=<?= $event['event_id'] ?>" class="btn btn-secondary m-2">Modifier</a>
                        <a href="index.php?action=deleteEvent&event_id=<?= $event['event_id'] ?>" class="btn btn-danger m-2">Supprimer</a>
                    </div>
                </div>
                <?php
            }
    } else {
        echo '<p>Pas de séance future</p>';
    }
    ?>
</section>
<section>
    <h2>Prochaines inscriptions</h2>
    <?php
    if (!empty($eventsReservations[0])) {
        foreach ($eventsReservations as $reservation) {
            ?>
            <?= $reservation['eventName'] ?><br />
            le <?= $reservation['eventDate_fr'] ?>
        <?php
        }
    } else {
        echo 'Pas de partie réservée.';
    }
    ?>
</section>

<?php $content = ob_get_clean();
require('template.php'); ?>
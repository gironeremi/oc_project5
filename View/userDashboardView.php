<?php $title = 'Tableau de bord';
ob_start(); ?>
<div class="jumbotron">
    <h1>Bienvenue <?= $_SESSION['username']; ?> !</h1>
    <p class=""></p>
</div>
<section>
    <h2 class="m-3">Prochaines séances organisées</h2>
    <?php
    if (!empty($events[0])) {
        foreach ($events as $event)
            {
                ?>
                <div class="card m-5 shadow">
                    <div class="card-header">
                        <h2 class="card-title"><?= $event['eventName'] ?> - <small><?= $event['gameName']?></small></h2>
                        <h5 class="card-subtitle mb-2 text-muted">le <?= $event['eventDate_fr'] ?> <br />
                            Organisé par <?= $event['username']?>
                        </h5>
                    </div>
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
    <h2 class="m-3">Prochaines inscriptions</h2>
    <?php
    if (!empty($eventsReservations[0])) {
        ?>
        <ul class="list-group m-5 shadow">
        <?php
        foreach ($eventsReservations as $reservation) {
            ?>
            <li class="list-group-item">
                <h5><?= $reservation['eventName']; ?><br />
                    <small class="text-muted">le <?= $reservation['eventDate_fr']; ?></small>
                </h5>
                <a href="index.php?action=getEventById&event_id=<?= $reservation['event_id']; ?>" class="btn btn-primary m-2">Consulter</a>
            </li>
        <?php
        }
        ?>
        </ul>
        <?php
    } else {
        echo 'Pas de partie réservée.';
    }
    ?>
</section>

<?php $content = ob_get_clean();
require('template.php'); ?>
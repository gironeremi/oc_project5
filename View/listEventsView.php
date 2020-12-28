<?php $title = 'Séances'; ?>
<?php ob_start(); ?>
    <h1 class="m-2 p-3">Prochaines séances</h1>
    <div class="">
        <?php
        foreach ($events as $event)
        {
        ?>
            <div class="card m-5 border-secondary shadow-lg">
                <div class="card-header">
                    <h2 class="card-title"><?= $event['eventName'] ?> — <small><?= $event['gameName']?></small></h2>

                </div>
                    <div class="card-body">
                        <h5 class="card-subtitle mb-2 text-muted">le <?= $event['eventDate_fr'] ?> <br />
                            Organisé par <?= $event['username']?>
                        </h5>
                        <a href="index.php?action=getEventById&event_id=<?= $event['event_id'] ?>" class="btn btn-lg btn-primary m-2">Plus d'infos</a>
                    </div>
                </div>
            </div>
    </div>
        <?php
        }
        ?>
    </div>
    <nav class="m-5 d-flex justify-content-center align-items-center">
        <ul class="pagination">
            <li class="page-item <?php if($currentPage == 1) { echo "disabled";} ?>">
                <a href="index.php?action=listEvents&page=<?= $currentPage - 1 ?>" class="page-link">&laquo;</a>
            </li>
            <?php
            for($page=1; $page<=$pages; $page++):
                ?>
                <li class="page-item <?php if($currentPage == $page){ echo "active"; }?>">
                    <a href="index.php?action=listEvents&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <li class="page-item <?php if($currentPage == $pages) { echo "disabled";} ?>">
                <a href="index.php?action=listEvents&page=<?= $currentPage + 1 ?>" class="page-link">&raquo;</a>
            </li>
        </ul>
    </nav>
<?php $content = ob_get_clean();
require('template.php'); ?>
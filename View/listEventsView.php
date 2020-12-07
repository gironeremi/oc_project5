<?php $title = 'Accueil'; ?>
<?php ob_start(); ?>
    <h1>Évènements à venir</h1>
    <div class="">
        <?php
        foreach ($events as $event)
        {
        ?>
            <div class="card m-5">
                <div class="card-header">
                    <h2 class="card-title"><?= $event['eventName'] ?> - <?= $event['gameName']?></h2>
                    <h5 class="card-subtitle mb-2 text-muted"><?= $event['eventDate'] ?> <br />
                        Organisé par <?= $event['username']?>
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $event['informations'] ?></p>
                </div>
                <div class="card-footer">
                    <p>Participants:</p>
                    <ul class="list-group">
                        <li class="list-group-item"></li>
                    </ul>
                </div>
                </div>
        <?php
        }
        ?>
    </div>
<!--    <nav>
        <ul class="pagination">
            <li class="page-item <?php if($currentPage == 1) { echo "disabled";} ?>">
                <a href="index.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
            </li>
            <?php
            for($page=1; $page<=$pages; $page++):
                ?>
                <li class="page-item <?php if($currentPage == $page){ echo "active"; }?>">
                    <a href="index.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <li class="page-item <?php if($currentPage == $pages) { echo "disabled";} ?>">
                <a href="index.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivant</a>
            </li>
        </ul>
    </nav>
    -->
<?php $content = ob_get_clean();
require('template.php'); ?>
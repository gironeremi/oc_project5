<?php $title = 'Accueil'; ?>
<?php ob_start(); ?>
    <h2>Évènements à venir</h2>
    <div class="d-md-flex justify-content-around">
        <?php
        foreach ($events as $event)
        {
        ?>
            <div class="card col-md-5 col-sm-10">
                    <div class="card-body">
                        <h4 class="card-title"><?= $event['eventName'] ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $event['eventDate'] ?></h6>
                        <p class="card-text"><?= $event['informations'] ?></p>
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
require('template.php'); ?><?php

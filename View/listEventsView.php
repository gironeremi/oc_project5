<?php $title = 'Accueil'; ?>
<?php ob_start(); ?>
    <h2>Évènements à venir</h2>
    <div class="d-md-flex justify-content-around">
        <div class="card col-md-5 col-sm-10">
            <div class="card-body">
                <h4 class="card-title">La forêt hantée enchantée en chantier</h4>
                <h6 class="card-subtitle mb-2 text-muted">Appel de Cthulhu</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
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

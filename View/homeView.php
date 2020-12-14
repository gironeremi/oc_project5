<?php $title = 'Accueil';
ob_start(); ?>
<section>
    <img src="/public/images/logo.png" alt="logo RMTJ" class="img-fluid" />
    <h1>Voici les jeux organisés par les membres:</h1>
    <ul>
        <?php
        foreach ($games as $game)
            {
        ?>
        <div class="container card-deck">
            <div class="card img-fluid" style="max-width: 500px">
                <img class="card-img-top" src="../public/images/<?= $game['picture'] ?>" alt="<?= $game['gameName'] ?>" style="width:100%">
                <div class="card-img-overlay">
                    <h2 class="card-title text-white bg-primary p-2 border-primary rounded shadow-lg"><?= $game['gameName'] ?></h2>
                    <h4 class="card-text text-white shadow-lg"><?= $game['style'] ?></h4>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </ul>
</section>
<?php $content = ob_get_clean();
require('template.php'); ?>
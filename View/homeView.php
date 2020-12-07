<?php $title = 'Accueil';
ob_start(); ?>
<section>
    <img src="/public/images/logo.png" alt="logo RMTJ" class="img-fluid" />
    <h1>Salut! Viens jouer!</h1>
    <h2>Voici les jeux organisés par les membres:</h2>
    <ul>
        <?php
        foreach ($games as $game)
            {
        ?>
            <dl>
                <dt><h3 class="font-weight-bold"><?= $game['gameName'] ?></h3></dt>
                <dd><h4><?= $game['style'] ?></h4></dd>
            </dl>
                <!--Ici, pourquoi pas mettre un truc déroulant animé en CSS ou en JS avec une description-->
        <?php
            }
        ?>
    </ul>
</section>

<?php $content = ob_get_clean();
require('template.php'); ?>
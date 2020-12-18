<?php $title = 'Accueil';
ob_start(); ?>
<section>
    <img src="/public/images/logo.png" alt="logo RMTJ" class="img-fluid" />
</section>
<section>
    <h1>Voici quelques jeux organisés par les membres:</h1>
    <ul>
        <?php
        foreach ($games as $game)
            {
        ?>
        <div class="">
            <h2 class=""><?= $game['gameName'] ?></h2>
            <h4 class=""><?= $game['style'] ?></h4>
        </div>
        <?php
            }
        ?>
    </ul>
</section>
<?php $content = ob_get_clean();
require('template.php'); ?>
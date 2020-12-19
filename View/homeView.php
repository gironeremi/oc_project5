<?php $title = 'Accueil';
ob_start(); ?>
    <link rel="stylesheet" href="../public/leaflet/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="../public/leaflet/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
<section>
    <img src="/public/images/logo.png" alt="logo RMTJ" class="img-fluid" />
</section>
<section>
<div id="mapid" class="m-auto col-xs-10 col-sm-10 col-md-10 col-lg-8 shadow-lg"></div>
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
<script type="text/javascript" src="../public/js/main.js"></script>
<?php $content = ob_get_clean();
require('template.php'); ?>
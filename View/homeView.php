<?php $title = 'Accueil';
ob_start(); ?>
<link rel="stylesheet" href="../public/leaflet/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
<script src="../public/leaflet/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<section class="d-flex justify-content-center align-items-center">
    <img src="/public/images/logo.png" alt="logo RMTJ" class="img-fluid" />
</section>
<section class="d-flex justify-content-center align-items-center">
    <div id="mapid" class="m-auto col-xs-10 col-sm-10 col-md-10 col-lg-8 shadow-lg"></div>
</section>
<section class="bg-secondary">
    <p class="btn btn-primary" id="weatherButton">Quel temps fait-il à Antibes?</p>
    <div id="antibesWeather">
        <h2>À <span id="city"></span></h2>
        <h3>la température est de <span id="temp"></span> °C </h3>
        <h4>et le temps est <span id="conditions"></span>.</h4>
    </div>

</section>
<section>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h2 class="mt-5 mb-2 text-center">Quelques jeux de rôle disponibles</h2>
        <h4>On en a plein!</h4>
        <?php
        foreach ($games as $game)
        {
        ?>
            <div class="card m-3 img-fluid shadow-lg" style="max-width: 800px">
            <img src="/public/images/<?= $game['picture']; ?>" class="card-img-top" alt="<?= $game['gameName']; ?>"/>
            <div class="card-img-overlay">
                <div class="card-title"><h2><span class="badge badge-primary"><?= $game['gameName']; ?></span></h2></div>
                <div class="card-text text-white"><h5 class="font-weight-bold"><?= $game['style']; ?></h5></div>
            </div>
        </div>
        <?php
        }
        ?>
</section>
<script type="text/javascript" src="../public/js/weather.js"></script>
<script type="text/javascript" src="../public/js/main.js"></script>
<?php $content = ob_get_clean();
require('template.php'); ?>
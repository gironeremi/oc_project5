<?php $title = 'Accueil';
ob_start(); ?>
<link rel="stylesheet" href="../public/leaflet/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
<script src="../public/leaflet/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<section class="d-flex flex-column justify-content-center align-items-center">
    <img src="/public/images/logo.png" alt="logo RMTJ" class="img-fluid" />
<div class="m-3">
    <h2 class="text-center">Qui sommes nous ?</h2>
    <p>RMTJ est un club antibois de jeu de rôle. Il a été fondé en 2007 par Cédrick Ledorme, amateur de jeux en tout genre. Le but de ce club est de présenter le jeu de rôle au grand public.</p>
</div>
</section>
<div class="m-3">
    <h2 class="text-center">Où nous trouver ?</h2>
</div>
<section class="d-flex justify-content-center align-items-center">
    <div id="mapid" class="m-auto col-xs-10 col-sm-10 col-md-10 col-lg-8 shadow-lg"></div>
</section>
<section class="bg-secondary m-5 shadow d-flex flex-column justify-content-center align-items-center">
    <div>
        <p class="btn btn-primary m-3 shadow-sm" id="weatherButton">Quel temps fait-il à Antibes?</p>
    </div>
    <div id="antibesWeather">
        <h3>À <span id="city"></span>, la température est de <span id="temp"></span> °C </h3>
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
<section">
    <h2 class="m-3 text-center">Alors, ça vous tente?</h2>
    <div class="d-flex justify-content-around align-items-center">
        <a class="btn btn-lg btn-primary" href="index.php?action=register">INSCRIVEZ-VOUS !</a>
        <a class="btn btn-lg btn-success" href="index.php?action=login">CONNECTEZ-VOUS !</a>
    </div>

</section>
<script type="text/javascript" src="../public/js/weather.js"></script>
<script type="text/javascript" src="../public/js/main.js"></script>
<?php $content = ob_get_clean();
require('template.php'); ?>
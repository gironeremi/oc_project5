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
    <!--Gabarit de caroussel
    <div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="la.jpg" alt="Los Angeles" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>We had such a great time in LA!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="chicago.jpg" alt="Chicago" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Chicago</h3>
        <p>Thank you, Chicago!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="ny.jpg" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>New York</h3>
        <p>We love the Big Apple!</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
    -->
</section>
<?php $content = ob_get_clean();
require('template.php'); ?>
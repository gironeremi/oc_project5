<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">RMTJ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" wfd-invisible="true">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Séances</a>
            </li>
<!-- -->
            <?php
                if (isset($_SESSION['username']))
            {?>
            <li class="nav nav-item nav-link">Salut <?= $_SESSION['username'] ?> !</li>
            <li class="nav nav-item">
                <a href="index.php?action=logout" class="nav-link">Déconnexion</a>
            </li>
            <?php }
                else {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=login">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=register">Inscription</a>
            </li>
        <?php } ?>

            <!--
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" wfd-invisible="true">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </li>
            -->
        </ul>
    </div>
</nav>
<?php if (!empty($successMessage)) {
    ?>
    <div id="successMessage" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $successMessage ?>
    </div>
<?php }
?>
<img src="/public/images/logo.png" alt="logo RMTJ" class="img-fluid col-lg-2"/>
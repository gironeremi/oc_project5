<?php $title = 'Connexion';
ob_start(); ?>
<div class="card m-5 p-4 shadow bg-white rounded d-flex flex-column justify-content-center align-items-center">
    <?php
    if (!empty($errors)) { ?>
        <div class="alert alert-danger col-md-8 m-3 p-3 shadow-sm">
            <p>Vous n'avez pas rempli le formulaire correctement:</p>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?= $error; ?></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
    <h1>Connexion</h1>
    <form method="post" action="" class="col-md-8 m-3 p-3 shadow-sm">
        <div class="form-group">
            <label for="username">Pseudo</label>
            <input type="text" name="username" class="form-control" maxlength="30" required />
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" class="form-control" maxlength="30" required />
            <button type="submit" class="btn btn-primary btn-block mt-4">Se connecter</button>
        </div>
    </form>
</div>
<?php $content = ob_get_clean();
require('template.php'); ?>
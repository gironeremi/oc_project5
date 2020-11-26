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
    <h2>Connexion</h2>
    <form method="post" action="" class="col-md-8 m-3 p-3 shadow-sm">
        <div class="form-group">
            <label for="memberName">Pseudo</label>
            <input type="text" name="memberName" class="form-control" />
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" class="form-control" />
            <button type="submit" class="btn btn-primary btn-block mt-4">Se connecter</button>
        </div>
    </form>
</div>
<?php $content = ob_get_clean();
require('template.php'); ?>
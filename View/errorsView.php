<?php
$title = 'Erreur';
ob_start(); ?>
    <div class="alert alert-danger mb-0 container-fluid">
        <p class="text-center"><strong>Erreur:</strong> <?= $exception->getMessage(); ?></p>
    </div>
<?php $content = ob_get_clean();
require('template.php'); ?>
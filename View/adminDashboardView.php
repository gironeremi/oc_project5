<?php $title = 'Panneau Administrateur'; ?>
<?php ob_start(); ?>

Salut, chef!

<?php $content = ob_get_clean();
require('template.php'); ?>

<?php $title = $post['title'];
ob_start(); ?>
<div class="card m-5 p-4 shadow bg-white rounded">
    <div class="card-body">
        <h2><?= $post['title'] ?></h2>
        <p><?= nl2br($post['content']) ?></p>
    </div>
    <div class="card-footer bg-white d-flex flex-column justify-content-center align-items-center">
        <?php
            if(!empty($previousPostId)) {
        ?>
                <a href="index.php?action=post&post_id=<?= $previousPostId; ?>" class="btn btn-secondary btn-block col-md-8"><i class="fas fa-angle-left"></i> épisode précédent <i class="fas fa-angle-left"></i></a>
        <?php
            }
        ?>
        <a href="index.php" class="btn btn-primary btn-block col-md-8"><i class="fas fa-home"></i> Retour Accueil <i class="fas fa-home"></i></a>
        <?php
            if(!empty($nextPostId)) {
        ?>
                <a href="index.php?action=post&post_id=<?= $nextPostId; ?>" class="btn btn-secondary btn-block col-md-8"><i class="fas fa-angle-right"></i> épisode suivant <i class="fas fa-angle-right"></i></a>
        <?php
            }
        ?>
    </div>
</div>
<div class="card m-5 p-4 shadow bg-white rounded d-flex flex-column justify-content-center align-items-center">
    <?php
        if (isset($_SESSION['memberName'])) {
    ?>
    <form action="index.php?action=addComment&id=<?= $post['post_id'] ?>" method="post" class="form-group col-md-8">
        <div>
            <h2>Un petit mot pour l'auteur?</h2>
            <label for="comment">N'hésitez pas à donner un avis constructif et respectueux.</label>
            <textarea id="comment" class="form-control mt-3 mb-4 shadow-sm" name="comment" placeholder="Saisissez ici votre commentaire" rows="3" maxlength="280" required></textarea>
        </div>
        <div class="mt-3 mb-2">
            <input type="submit" class="btn btn-primary btn-block"/>
        </div>
    </form>
    <?php
    } else {
        echo '<div class="alert alert-info col-md-8 text-center"><strong><i class="fas fa-exclamation"></i> Attention: </strong>Pour laisser un commentaire, veuillez <a href="index.php?action=login">vous connecter.</a></div>';
    }
    ?>
</div>
<div class="card m-5 p-4 shadow bg-white rounded d-flex flex-column justify-content-center align-items-center">
    <h2 class="">Commentaires</h2>
    <?php
        foreach ($comments as $comment) {
    ?>
    <div class="card col-md-8 m-3 p-3 shadow-sm">
        <h4 class="card-title p-3"><?= $comment['member_name'] ?> a dit:</h4>
        <p class="card-text"><?= nl2br($comment['comment']) ?></p>
        <p class="card-text font-italic text-muted">le <?= $comment['comment_date_fr']?></p>
        <?php
            if (isset($_SESSION['memberName']) && $comment['status'] == 0 ) {
        ?>
            <a href="index.php?action=flagComment&comment_id=<?= $comment['comment_id'];?>" class="btn btn-danger btn-sm">Signaler ce commentaire</a>
        <?php
            }
            elseif ($comment['status'] == 1) {
                echo '<div class="text-danger text-right"><i class="fas fa-user-clock"></i> En cours de modération.</div>';
            }
            if ($comment['status'] == 2) {
                echo '<div class="text-success text-right"><i class="fas fa-user-check"></i> Commentaire validé.</div>';
            }
        ?>
    </div>
    <?php
        }
    ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

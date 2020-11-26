<?php $title = 'Editeur de chapitre'; ?>

<?php ob_start(); ?>
<script type="text/javascript">
    tinymce.init({
        selector: '#postContent',
        language: 'fr_FR',
        language_url: '/vendor/tinymce/tinymce/langs/fr_FR.js',
    });
</script>
<div class="card m-5 p-4 shadow bg-white rounded d-flex flex-column justify-content-center align-items-center">
    <h2>Éditeur de Texte</h2>
<form method="post" class="form-group col-md-8 m-3 p-3 shadow-sm"
      <?php
      if(!empty($post)) {?>
          action="index.php?action=updatePost&post_id=<?= $post['post_id'] ?>"
      <?php } else { ?>
          action="index.php?action=addPost"
      <?php
      }
      ?>
  >
    <div class="form-group">
        <label for="postTitle">Titre de l'épisode : </label><input type="text" name="postTitle" class="form-control" value="
        <?php
            if(!empty($post['title'])) {
                echo $post['title'];
            }
        ?>
        "/>
    </div>

    <label for="postContent">Contenu de l'épisode : </label><br />
    <p><textarea id="postContent" class="form-control" name="postContent" rows="15">
    <?php
        if(!empty($post['content'])) {
            echo $post['content'];
        }
    ?>
    </textarea>
    </p>
    <p>
        <label for="postPublishDate">Date de publication : </label><input type="date" name="postPublishDate" class="form-control" value="<?= date('Y-m-d') ?>" />
    </p>
    <button type="submit" class="btn btn-primary btn-block mt-4">Valider</button>
</form>
</div>
<?php $content = ob_get_clean();
require('template.php'); ?>
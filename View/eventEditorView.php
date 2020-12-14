<?php $title = 'Éditeur d\'Aventure'; ?>
<?php ob_start(); ?>
<div class="card m-5 p-4 shadow bg-white rounded d-flex flex-column justify-content-center align-items-center">
    <h2>Séance de jeu</h2>
    <form method="post" class="form-group col-md-8 m-3 p-3 shadow-sm"
          <?php
          if(!empty($event)) {?>
              action="index.php?action=updateEvent&event_id=<?= $event['event_id'] ?>"
          <?php } else { ?>
              action="index.php?action=addEvent"
          <?php
          }
          ?>
    >
        <div class="form-group">
            <label for="eventName">Nom de l'aventure : </label><input type="text" name="eventName" class="form-control" value="<?php
                if(!empty($event['eventName'])) {
                    echo $event['eventName'];
                }
            ?>"/>
        </div>
        <div>
            <div class="form-group row">
                <label for="gameName" class="col-4 col-form-label">Quel jeu?</label>
                <div class="col-8">
                    <select id="game_id" name="game_id" class="custom-select" aria-describedby="game_idHelpBlock" required="required">
                        <option value="" selected disabled>Choisissez un jeu</option>
                        <?php
                        foreach ($games as $game)
                            {
                        ?>
                            <option value="<?= $game['game_id'] ?>">
                                <?= $game['gameName'] ?>
                            </option>
                        <?php
                            }
                        ?>
                    </select>
                    <span id="game_idHelpBlock" class="form-text text-muted">Veuillez choisir dans cette liste</span>
                </div>
            </div>
        </div>
        <label for="eventInformations">Description de la séance : </label><br />
        <p><textarea id="eventInformations" class="form-control" name="eventInformations" rows="15"><?php
            if(!empty($event['informations'])) {
                echo strip_tags($event['informations']);
            }
        ?></textarea>
        </p>
        <p>
            <label for="eventDate">Rendez-vous le : </label><input type="date" name="eventDate" class="form-control" value="<?php if(!empty($event)){echo $event['eventDate'];}else { echo date('Y-m-d');} ?>" />
        </p>
        <button type="submit" class="btn btn-primary btn-block mt-4">Valider</button>
    </form>
</div>
<?php $content = ob_get_clean();
require('template.php'); ?>
<?php ob_start(); ?>

        <!-- Template message utilisateur -->
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-4 mb-4">
            </div>
            <div class="col-12 col-sm-12 col-lg-8 mb-8" id="userMessage">
                <p id="message">
                    <!--<?= $content ?>-->contenu message1
                </p>
                <hr>
                <p>
                    <!--<?= $username ?>-->username | <!--<?= $creationdate ?>-->date
                </p>
            </div>
        </div>

        <!-- Template message other -->
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-8 mb-8" id="otherMessage">
                <p id="message">
                    <!--<?= $content ?>-->contenu message2
                </p>
                <hr>
                <p>
                    <!--<?= $username ?>-->username | <!--<?= $creationdate ?>-->date
                </p>
            </div>
        <div class="col-12 col-sm-12 col-lg-4 mb-4">
        </div>
        </div>



<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
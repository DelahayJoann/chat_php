<?php ob_start(); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-3 col-lg-3 mb-3">
        </div>
        <div class="col-12 col-sm-6 col-lg-6 mb-6" id="box">
            



        </div>
        <div class="col-12 col-sm-3 col-lg-3 mb-3">
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
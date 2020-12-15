<?php ob_start(); ?>

<footer>
    test
</footer>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
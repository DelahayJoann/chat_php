<?php ob_start(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-3 mb-3">
        </div>
        <div class="col-12 col-sm-12 col-lg-6 mb-6">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">100% Bootstrap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">caractéristiques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">s'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">se connecter</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-12 col-sm-12 col-lg-3 mb-3">
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
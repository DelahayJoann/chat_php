<div class="modal" id="signin">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Connexion</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="login" method="post">
                    <div class="form-group">
                        <label>email :</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre adresse email." required>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password"
                        placeholder="Entrer un mot de passe." required>
                    </div>
                        <input type="submit" class="btn btn-primary" value="Connexion">
                </form>
            </div>
        </div>
    </div>
</div>
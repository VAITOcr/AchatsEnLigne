<?php

?>

<div class="container">  
  <!-- Modal Enregistrement -->
  <div class="modal fade" id="idEnreg" tabindex="-1" role="dialog" aria-labelledby="ModalEnregLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="ModalEnregLabel">Enregistrer membre</h4>
        </div>
        <div class="modal-body">
          <form id="idFormEnreg" action="serveur/src/controleurs/controleurMembre.php" method="POST"
                enctype="multipart/form-data" class="row" onSubmit="return validerFormEnreg();" autocomplete="off">
            <div class="form-group col-md-6">
              <label for="prenom">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group col-md-12">
              <label for="courriel">Courriel</label>
              <input type="email" class="form-control" id="courriel" name="courriel" required>
            </div>
            <div class="form-group col-md-6">
              <label for="mdp">Mot de passe</label>
              <input type="password" class="form-control" id="mdp" name="mdp" required>
            </div>
            <div class="form-group col-md-6">
              <label for="mdpc">Confirmer mot de passe</label>
              <input type="password" class="form-control" id="mdpc" name="mdpc" required>
              <span id="msgPass"></span>
            </div>
            <div class="form-group col-md-6">
              <label for="sexe">Sexe</label>
              <select class="form-control" id="sexe" name="sexe">
                <option selected disabled value="">Choisir</option>
                <option value="F">Féminin</option>
                <option value="M">Masculin</option>
                <option value="A">Autres</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="daten">Date de naissance</label>
              <input type="date" class="form-control" id="daten" name="daten">
            </div>
            <div class="form-group col-md-12">
              <label for="photo">Photo</label>
              <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <input type="hidden" name="action" value="enregistrer">
            <div class="col-md-12 text-right">
              <button class="btn btn-primary" type="submit">Enregistrer</button>
              <button class="btn btn-secondary" type="reset">Vider</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Connexion -->
  <div class="modal fade" id="idConnexion" tabindex="-1" role="dialog" aria-labelledby="ModalConnexionLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="ModalConnexionLabel">Connexion</h4>
        </div>
        <div class="modal-body">
          <form class="row" id="idFormConnexion" action="serveur/src/connexion/connexion.php" method="POST" autocomplete="off">
            <div class="form-group col-md-12">
              <label for="courrielco">Courriel</label>
              <input type="email" class="form-control" id="courrielco" name="courrielco" required>
            </div>
            <div class="form-group col-md-12">
              <label for="mdpco">Mot Passe</label>
              <input type="password" class="form-control" id="mdpco" name="mdpco" required>
            </div>
            <div class="col-md-12 text-right">
              <button class="btn btn-primary" type="submit">Connexion</button>
              <button class="btn btn-secondary" type="reset">Vider</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
?>

<!-- Modal Ajouter / Modifier Article -->
<div class="modal fade" id="modalArticle" tabindex="-1" role="dialog" aria-labelledby="modalArticleLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="modalArticleLabel">Ajouter / Modifier un Article</h4>
      </div>
      <form id="form-article" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" id="article-id" name="id">

          <div class="form-group">
            <label for="article-nom">Nom</label>
            <input type="text" class="form-control" id="article-nom" name="name" required>
          </div>

          <div class="form-group">
            <label for="article-categorie">Catégorie</label>
            <select class="form-control" id="article-categorie" name="categorie" required>
              <option value="Smartphone">Smartphone</option>
              <option value="Laptop">Laptop</option>
              <option value="Moniteur">Moniteur</option>
              <option value="Accessories">Accessories</option>
              <option value="Autres">Autres</option>
            </select>
          </div>

          <div class="form-group">
            <label for="article-prix">Prix</label>
            <input type="number" step="0.01" class="form-control" id="article-prix" name="price" required>
          </div>

          <div class="form-group">
            <label for="article-photo">Photo (JPEG/PNG)</label>
            <input type="file" class="form-control" id="article-photo" name="photo">
            <img id="article-photo-preview" src="" style="max-width: 100px; display: none; margin-top: 10px;" />
          </div>

          <div class="form-group">
            <label for="article-description">Description</label>
            <textarea class="form-control" id="article-description" name="description" rows="4" required></textarea>
          </div>

            <div class="form-group">
                <label for="article-featured">Featured</label>
                <select name="article-featured" id="article-featured" class="form-control">

                    <option value="Y">Oui</option>
                    <option value="N">Non</option>
                </select>
            </div>

            <div class="form-group">
                <label for="article-rating">Rating</label>
                <input type="number" class="form-control" id="article-rating" name="rating" required min="0" max="5">
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Confirmation de Suppression -->
<div class="modal fade" id="modalSupprimer" tabindex="-1" role="dialog" aria-labelledby="modalSupprimerLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="modalSupprimerLabel">Confirmer la suppression</h4>
      </div>
      <div class="modal-body">
        <p>Êtes-vous sûr de vouloir supprimer l’article <strong id="nom-article-a-supprimer">...</strong> ?</p>
        <input type="hidden" id="id-article-a-supprimer">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="btn-confirmer-suppression">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ajouter / Modifier Utilisateur -->
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="modalUserLabel">Ajouter / Modifier un Utilisateur</h4>
      </div>
      <form id="form-user" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" id="user-id" name="idm">

          <div class="form-group">
            <label for="user-nom">Nom</label>
            <input type="text" class="form-control" id="user-nom" name="nom" required>
          </div>

          <div class="form-group">
            <label for="user-prenom">Prénom</label>
            <input type="text" class="form-control" id="user-prenom" name="prenom" required>
          </div>

          <div class="form-group">
            <label for="user-sexe">Sexe</label>
            <select class="form-control" id="user-sexe" name="sexe" required>
              <option value="M">Masculin</option>
              <option value="F">Féminin</option>
              <option value="A">Autre</option>
            </select>
          </div>

          <div class="form-group">
            <label for="user-daten">Date de naissance</label>
            <input type="date" class="form-control" id="user-daten" name="daten" required>
          </div>

          <div class="form-group">
            <label for="user-photo">Photo (JPEG/PNG)</label>
            <input type="file" class="form-control" id="user-photo" name="photo">
            <img id="user-photo-preview" src="" style="max-width: 100px; display: none; margin-top: 10px;" />
          </div>

          <div class="form-group">
            <label for="user-courriel">Courriel</label>
            <input type="email" class="form-control" id="user-courriel" name="courriel" required>
          </div>

          <div class="form-group">
            <label for="user-pass">Mot de passe</label>
            <input type="password" class="form-control" id="user-pass" name="pass">
          </div>

          <div class="form-group">
            <label for="user-role">Role</label>
            <select class="form-control" id="user-role" name="role" required>
              <option value="A">Administrateur</option>
              <option value="M">Membre</option>
            </select>
          </div>

          <div class="form-group">
            <label for="user-statut">Statut</label>
            <select class="form-control" id="user-statut" name="statut" required>
              <option value="A">Actif</option>
              <option value="I">Inactif</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ajouter Membre -->
<div class="modal fade" id="modalAjouterMembre" tabindex="-1" role="dialog" aria-labelledby="ajoutMembreLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="ajoutMembreLabel">Ajouter un membre</h4>
      </div>

      <form id="form-ajout-membre"  enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="action" value="addMembre">

          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
          </div>

          <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
          </div>

          <div class="form-group">
            <label for="sexe">Sexe</label>
            <select class="form-control" id="sexe" name="sexe" required>
              <option value="M">Masculin</option>
              <option value="F">Féminin</option>
              <option value="A">Autre</option>
            </select>
          </div>

          <div class="form-group">
            <label for="daten">Date de naissance</label>
            <input type="date" class="form-control" id="daten" name="daten" required>
          </div>

          <div class="form-group">
            <label for="photo">Photo (JPEG/PNG)</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg, image/png" required>
            <img id="photo-preview" src="" style="max-width: 100px; margin-top: 10px; display: none;" />
          </div>

          <div class="form-group">
            <label for="courriel">Courriel</label>
            <input type="email" class="form-control" id="courriel" name="courriel" required>
          </div>

          <div class="form-group">
            <label for="pass">Mot de passe</label>
            <input type="password" class="form-control" id="pass" name="pass" required>
          </div>

          <div class="form-group">
            <label for="role">Rôle</label>
            <select class="form-control" id="role" name="role" required>
              <option value="A">Administrateur</option>
              <option value="M">Membre</option>
            </select>
          </div>

          <div class="form-group">
            <label for="statut">Statut</label>
            <select class="form-control" id="statut" name="statut" required>
              <option value="A">Actif</option>
              <option value="I">Inactif</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Ajouter</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal de suppression d'un membre -->
<div class="modal fade" id="modalSupprimerMembre" tabindex="-1" role="dialog" aria-labelledby="modalSupprimerMembreLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="modalSupprimerMembreLabel">Confirmer la suppression du membre</h4>
      </div>
      
      <div class="modal-body">
        <p>Voulez-vous vraiment supprimer ce membre&nbsp;?</p>
        <p><strong id="nom-membre-a-supprimer">Nom Inconnu</strong></p>
        <input type="hidden" id="id-membre-a-supprimer">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="btn-confirmer-suppression-membre">Supprimer</button>
      </div>
      
    </div>
  </div>
</div>
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

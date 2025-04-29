document.addEventListener("DOMContentLoaded", () => {
  chargerArticles();

  document.getElementById("btn-articles").addEventListener("click", (e) => {
    e.preventDefault();
    chargerArticles();
  });

  document.getElementById("btn-users").addEventListener("click", (e) => {
    e.preventDefault();
    chargerUsers();
  });

  document
    .getElementById("form-article")
    .addEventListener("submit", enregistrerArticle);

  document
    .getElementById("btn-confirmer-suppression")
    .addEventListener("click", confirmerSuppression);
});

function showToast(message) {
  const toast = document.getElementById("admin-toast");
  toast.textContent = message;
  toast.style.display = "block";
  setTimeout(() => {
    toast.style.display = "none";
  }, 3000);
}

let articleASupprimer = null;
let articleAModifier = null;
let pageActuelle = 1;
let articlesParPage = 5;
let allArticles = [];

function chargerArticles() {
  fetch(window.serveurUrl + "../routesArticles.php?action=getAllArticles")
    .then((res) => res.json())
    .then((data) => {
      if (data.etat && Array.isArray(data.donnees)) {
        allArticles = data.donnees;
        afficherTableArticles();
      } else {
        showToast("Erreur lors du chargement des articles");
      }
    })
    .catch((err) => console.error("Erreur lors du fetch articles :", err));
}

function chargerUsers() {
  const contenu = document.getElementById("contenu-dynamique");
  contenu.innerHTML = `
    <h3>Liste des Utilisateurs</h3>
    <p>La gestion des utilisateurs arrive bientôt.</p>
  `;
}

function afficherTableArticles() {
  const contenu = document.getElementById("contenu-dynamique");
  const start = (pageActuelle - 1) * articlesParPage;
  const end = start + articlesParPage;
  const pageArticles = allArticles.slice(start, end);

  let html = `
    <h3>Liste des Articles</h3>
    <button class="btn btn-success" id="btn-ajouter-article"><i class="fa fa-plus"></i> Ajouter un Article</button>
    <table class="table table-bordered table-striped" style="margin-top:15px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Photo</th>
          <th>Nom</th>
          <th>Description</th>
          <th>Prix</th>
          <th>Featured</th>
          <th>Rating</th>
          <th>Catégorie</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
  `;

  pageArticles.forEach((article) => {
    html += `
      <tr>
        <td>${article.id}</td>
        <td><img src="${window.serveurUrl}photos/${article.photo}" alt="${
      article.name
    }" style="width: 50px; height: auto; border-radius: 4px;"></td>
        <td>${article.name}</td>
        <td>${article.description}</td>
        <td>${article.price} $</td>
        <td>${article.featured === "Y" ? "Y" : "N"}</td>
        <td>${article.rating}</td>
        <td>${article.categorie}</td>
        <td>
          <button class="btn btn-primary btn-xs btn-edit"
            data-id="${article.id}"
            data-name="${article.name}"
            data-categorie="${article.categorie}"
            data-price="${article.price}"
            data-photo="${article.photo}"
            data-featured="${article.featured}"
            data-rating="${article.rating}"
            data-description="${article.description}">Modifier</button>
          <button class="btn btn-danger btn-xs btn-delete" data-id="${
            article.id
          }">Supprimer</button>
        </td>
      </tr>
    `;
  });

  html += `
      </tbody>
    </table>
    <div id="pagination" class="text-center" style="margin-top: 15px;"></div>
  `;

  contenu.innerHTML = html;
  ajouterListenersBoutons();
  afficherPagination();
}

function ajouterListenersBoutons() {
  document.querySelectorAll(".btn-edit").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const target = e.currentTarget;
      const article = {
        id: target.dataset.id,
        name: target.dataset.name,
        categorie: target.dataset.categorie,
        description: target.dataset.description,
        price: target.dataset.price,
        photo: target.dataset.photo,
        featured: target.dataset.featured,
        rating: target.dataset.rating,
      };
      ouvrirModalModifier(article);
    });
  });

  document.querySelectorAll(".btn-delete").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const id = e.currentTarget.getAttribute("data-id");
      ouvrirModalSupprimer(id);
    });
  });

  const boutonAjouter = document.getElementById("btn-ajouter-article");
  if (boutonAjouter) {
    boutonAjouter.addEventListener("click", () => {
      const form = document.getElementById("form-article");
      form.reset();
      const imgPreview = document.getElementById("article-photo-preview");
      if (imgPreview) {
        imgPreview.src = "";
        imgPreview.style.display = "none";
      }
      document.getElementById("article-id").value = "";
      $("#modalArticle").modal("show");
    });
  }
}

function afficherPagination() {
  const pagination = document.getElementById("pagination");
  const totalPages = Math.ceil(allArticles.length / articlesParPage);
  let html = "";

  for (let i = 1; i <= totalPages; i++) {
    html += `<button class="btn btn-sm ${
      i === pageActuelle ? "btn-primary" : "btn-default"
    }" style="margin: 2px;" data-page="${i}">${i}</button>`;
  }

  pagination.innerHTML = html;

  pagination.querySelectorAll("button").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      pageActuelle = parseInt(e.target.getAttribute("data-page"));
      afficherTableArticles();
    });
  });
}

function enregistrerArticle(e) {
  e.preventDefault();
  const form = document.getElementById("form-article");
  const formData = new FormData(form);
  const id = formData.get("id");
  const action = id ? "updateArticle" : "addArticle";

  fetch(window.serveurUrl + "../routesArticles.php?action=" + action, {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        showToast(id ? "Article modifié" : "Article ajouté");
        $("#modalArticle").modal("hide");
        chargerArticles();
      } else {
        showToast(data.message || "Erreur lors de l'enregistrement");
      }
    })
    .catch((err) => console.error("Erreur :", err));
}

function ouvrirModalModifier(article) {
  document.getElementById("article-id").value = article.id;
  document.getElementById("article-nom").value = article.name;
  document.getElementById("article-categorie").value = article.categorie;
  document.getElementById("article-prix").value = article.price;
  document.getElementById("article-featured").value =
    article.featured === "Y" ? "Y" : "N";
  document.getElementById("article-rating").value = article.rating;
  document.getElementById("article-description").value = article.description;

  const imgPreview = document.getElementById("article-photo-preview");
  if (article.photo && imgPreview) {
    imgPreview.src = `${window.serveurUrl}photos/${article.photo}`;
    imgPreview.style.display = "block";
  }

  $("#modalArticle").modal("show");
}

function confirmerSuppression() {
  const id = document.getElementById("id-article-a-supprimer").value;
  fetch(
    window.serveurUrl + "../routesArticles.php?action=deleteArticle&id=" + id,
    {
      method: "GET",
    }
  )
    .then((res) => res.json())
    .then((data) => {
      if (data.success || data.etat) {
        showToast("Article supprimé !");
        $("#modalSupprimer").modal("hide");
        chargerArticles();
      } else {
        showToast("Erreur lors de la suppression");
      }
    })
    .catch((err) => console.error("Erreur lors de la suppression :", err));
}

function ouvrirModalSupprimer(id) {
    const article = allArticles.find((a) => String(a.id) === String(id));
    if (!article) {
      showToast("Article introuvable");
      return;
    }
  document.getElementById("id-article-a-supprimer").value = id;
  document.getElementById("nom-article-a-supprimer").textContent = article.name;
  $("#modalSupprimer").modal("show");
}

document.addEventListener("DOMContentLoaded", () => {
  chargerArticles();
  ajouterMembre();
  const btnConfirmerSuppression = document.getElementById(
    "btn-confirmer-suppression-membre"
  );
  if (btnConfirmerSuppression) {
    btnConfirmerSuppression.addEventListener("click", () => {
      const id = document.getElementById("id-membre-a-supprimer").value;
      if (!id) {
        showToast("Membre introuvable");
        return;
      }
      supprimerMembre(id);
    });
  }

  document.getElementById("btn-articles").addEventListener("click", (e) => {
    e.preventDefault();
    chargerArticles();
    setActiveSidebarButton("btn-articles");
  });

  document.getElementById("btn-users").addEventListener("click", (e) => {
    e.preventDefault();
    chargerMembres();
    setActiveSidebarButton("btn-users");
  });
  document
    .getElementById("form-article")
    .addEventListener("submit", enregistrerArticle);
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
let pageActuelleMembres = 1;
let membresParPage = 5;
let allArticles = [];
let allMembres = [];

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

function chargerMembres() {
  fetch(window.serveurUrl + "../routesMembres.php?action=getAllMembres")
    .then((res) => res.json())
    .then((data) => {
      if (data.etat && Array.isArray(data.donnees)) {
        allMembres = data.donnees;
        afficherTableUsers();
      } else {
        showToast("Erreur lors du chargement des utilisateurs");
      }
    });
}

function afficherTableUsers() {
  const contenu = document.getElementById("contenu-dynamique");
  const start = (pageActuelleMembres - 1) * membresParPage;
  const end = start + membresParPage;
  const pageMembres = allMembres.slice(start, end);
  let html = `
    <h3>Liste des Membres</h3>
     <button class="btn btn-success" id="btn-ajouter-user"><i class="fa fa-plus"></i> Ajouter un membre</button>
    <table class="table table-bordered table-striped" style="margin-top:15px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Sexe</th>
          <th>Daten</th>
          <th>Photo</th>
          <th>Courriel</th>
          <th> Pass </th>
          <th>Role</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
  `;

  pageMembres.forEach((membres) => {
    html += `
      <tr>
        <td>${membres.idm}</td>
        <td>${membres.nom}</td>
        <td>${membres.prenom}</td>
        <td>${membres.sexe}</td>
        <td>${membres.daten}</td>
        <td>
  ${
    membres.photo
      ? `<img src="${window.serveurUrl}photos/membresPhotos/${membres.photo}" alt="${membres.nom}" style="width: 50px; height: auto; border-radius: 4px;">`
      : `<span style="color: gray;">Pas de photo</span>`
  }
</td>
        <td>${membres.courriel}</td>
        <td>${membres.pass}</td>
        <td>${membres.role}</td>
        <td>${membres.statut}</td>
        <td>
          <button class="btn btn-primary btn-xs btn-edit-membre" 
            data-id="${membres.idm}"
    data-nom="${membres.nom}"
    data-prenom="${membres.prenom}"
    data-sexe="${membres.sexe}"
    data-daten="${membres.daten}"
    data-photo="${membres.photo}"
    data-courriel="${membres.courriel}"
    data-role="${membres.role}"
    data-statut="${membres.statut}"> <i class="fa fa-pencil"></i> </button>
          <button class="btn btn-danger btn-xs btn-delete-membre" data-id="${
            membres.idm
          }"> <i class="fa fa-trash"></i> </button>
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
  afficherPaginationMembres();
}

function afficherPaginationMembres() {
  const pagination = document.getElementById("pagination");
  const totalPages = Math.ceil(allMembres.length / articlesParPage);
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
            data-description="${
              article.description
            }"> <i class="fa fa-pencil"></i> </button>
          <button class="btn btn-danger btn-xs btn-delete" data-id="${
            article.id
          }"> <i class="fa fa-trash"></i> </button>
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
  document.querySelectorAll(".btn-edit-membre").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const btnUser = e.currentTarget;
      const form = document.getElementById("form-user");

      // Charger les données
      document.getElementById("user-id").value = btnUser.dataset.id;
      document.getElementById("user-nom").value = btnUser.dataset.nom;
      document.getElementById("user-prenom").value = btnUser.dataset.prenom;
      document.getElementById("user-sexe").value = btnUser.dataset.sexe;
      document.getElementById("user-daten").value = btnUser.dataset.daten;
      document.getElementById("user-courriel").value = btnUser.dataset.courriel;
      document.getElementById("user-role").value = btnUser.dataset.role;
      document.getElementById("user-statut").value = btnUser.dataset.statut;

      const photoPreview = document.getElementById("user-photo-preview");
      if (btnUser.dataset.photo && btnUser.dataset.photo !== "null") {
        photoPreview.src = `${window.serveurUrl}photos/membresPhotos/${btnUser.dataset.photo}`;
        photoPreview.style.display = "block";
      } else {
        photoPreview.style.display = "none";
      }

      // Supprimer les anciens submit listeners (éviter doublons)
      form.removeEventListener("submit", ajouterMembre);
      form.removeEventListener("submit", modifierMembre);
      form.addEventListener("submit", modifierMembre);

      $("#modalUser").modal("show");
    });
  });
  const btnAjouterUser = document.getElementById("btn-ajouter-user");
  if (btnAjouterUser) {
    btnAjouterUser.addEventListener("click", () => {
      const form = document.getElementById("form-ajout-membre");
      form.reset();

      const photoPreview = document.getElementById("photo-preview");
      if (photoPreview) {
        photoPreview.src = "";
        photoPreview.style.display = "none";
      }

      $("#modalAjouterMembre").modal("show");
    });

    document.querySelectorAll(".btn-delete-membre").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const id = e.currentTarget.getAttribute("data-id");

        if (e.currentTarget.closest("table").innerHTML.includes("Prenom")) {
          const membre = allMembres.find((m) => String(m.idm) === String(id));
          if (!membre) {
            showToast("Membre introuvable");
            return;
          }

          document.getElementById("id-membre-a-supprimer").value = membre.idm;
          document.getElementById("nom-membre-a-supprimer").textContent =
            membre.nom + " " + membre.prenom;
          $("#modalSupprimerMembre").modal("show");
        } else {
          ouvrirModalSupprimer(id);
        }
      });
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
  const btnSupp = document.getElementById("btn-confirmer-suppression");
  btnSupp.addEventListener("click",()=>{
    confirmerSuppression()
  })
}

function setActiveSidebarButton(activeId) {
  const sidebarLinks = document.querySelectorAll("#sidebar-admin a");
  sidebarLinks.forEach((link) => {
    link.classList.remove("active");
  });

  const activeLink = document.getElementById(activeId);
  if (activeLink) {
    activeLink.classList.add("active");
  }
}

function modifierMembre(e) {
  e.preventDefault();
  const formData = new FormData();

  // Récupérer les champs du formulaire manuellement
  const id = document.getElementById("user-id").value;
  const nom = document.getElementById("user-nom").value;
  const prenom = document.getElementById("user-prenom").value;
  const sexe = document.getElementById("user-sexe").value;
  const daten = document.getElementById("user-daten").value;
  const courriel = document.getElementById("user-courriel").value;
  const pass = document.getElementById("user-pass").value;
  const role = document.getElementById("user-role").value;
  const statut = document.getElementById("user-statut").value;
  const photo = document.getElementById("user-photo").files[0];

  const action = "updateMembre";

  // Ajouter uniquement le fichier en FormData
  if (photo) formData.append("photo", photo);
  if (pass) formData.append("pass", pass); // laisser vide si vide

  const queryParams = new URLSearchParams({
    action,
    idm: id,
    nom,
    prenom,
    sexe,
    daten,
    courriel,
    role,
    statut,
  });

  fetch(`${window.serveurUrl}../routesMembres.php?${queryParams.toString()}`, {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log("DEBUG réponse :", data);
      if (data.success || data.etat) {
        showToast(id ? "Membre modifié" : "Membre ajouté");
        $("#modalUser").modal("hide");
        chargerMembres();
      } else {
        showToast(data.message || "Erreur lors de l'enregistrement");
      }
    })
    .catch((err) => console.error("Erreur :", err));
}

function ajouterMembre() {
  document
    .getElementById("form-ajout-membre")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      // DEBUG : vérifier ce que contient FormData
      console.log("FormData envoyée :", [...formData.entries()]);


      fetch(window.serveurUrl + "../routesMembres.php?action=addMembre", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.etat) {
            showToast(" Membre ajouté !");
            $("#modalAjouterMembre").modal("hide");
            chargerMembres();
          } else {
            showToast(data.message || "❌ Erreur lors de l’ajout.");
          }
        })
        .catch((err) => {
          console.error("Erreur réseau :", err);
          showToast("Erreur réseau.");
        });
    });
}

function ouvrirModalSupprimerMembre(id) {
  const membre = allMembres.find((m) => String(m.idm) === String(id));
  if (!membre) {
    showToast(" Membre introuvable");
    return;
  }

  document.getElementById("id-membre-a-supprimer").value = membre.idm;
  document.getElementById("nom-membre-a-supprimer").textContent =
    membre.nom + " " + membre.prenom;

  $("#modalSupprimerMembre").modal("show");
}

function supprimerMembre(id) {
  if (!id) {
    showToast(" Membre introuvable");
    return;
  }

  const params = new URLSearchParams({
    action: "deleteMembre",
    idm: id,
  });

  fetch(`${window.serveurUrl}../routesMembres.php?${params.toString()}`, {
    method: "GET",
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.etat || data.success) {
        showToast(" Membre supprimé !");
        $("#modalSupprimerMembre").modal("hide");
        chargerMembres();
      } else {
        showToast(" " + (data.message || "Erreur lors de la suppression"));
      }
    })
    .catch((err) => {
      console.error("Erreur réseau suppression :", err);
      showToast("Erreur réseau.");
    });
}

import { articlesFeatured } from "./vuesArticles.js";

let allArticles = [];
let articlesFiltred = [];
let pageActuelle = 1;
let articlesParPage = 6;
let htmlInitiale = "";
let panierClickListener;

function setupPanierInteraction() {
  const interval = setInterval(() => {
    const panierButton = document.getElementById("panier-button");
    const miniPanier = document.getElementById("mini-panier");
    const closePanier = document.getElementById("close-panier");

    if (panierButton && miniPanier && closePanier) {
      clearInterval(interval);

      panierButton.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        miniPanier.style.display =
          miniPanier.style.display === "none" ? "block" : "none";
      });

      closePanier.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        miniPanier.style.display = "none";
      });

      document.addEventListener("click", (e) => {
        if (!miniPanier.contains(e.target) && e.target !== panierButton) {
          miniPanier.style.display = "none";
        }
      });

      miniPanier.addEventListener("click", (e) => {
        e.stopPropagation();
      });
    }
  }, 100);
}

function getPanierKey() {
  return `panier_${window.utilisateurId}`;
}

export function initPanier() {
  setupPanierInteraction();
  afficherMiniPanier();
  mettreAJourCompteurPanier();

  if (panierClickListener) {
    document.removeEventListener("click", panierClickListener);
  }

   panierClickListener = function (event){
    if (
      event.target.closest(".add-to-cart-btn") &&
      window.utilisateurRole === "M"
    ) {
      const btn = event.target.closest(".add-to-cart-btn");
      const id = btn.dataset.id;
      const name = btn.dataset.name;
      const price = parseFloat(btn.dataset.price);
      const photo = btn.dataset.photo;

      const cart = JSON.parse(localStorage.getItem(getPanierKey())) || [];

      const existing = cart.find((item) => item.id === id);
      if (existing) {
        existing.qty += 1;
      } else {
        cart.push({ id, name, price, photo, qty: 1 });
      }

      localStorage.setItem(getPanierKey(), JSON.stringify(cart));
      afficherMiniPanier();
      afficherToastPanier(name, photo); // Affiche le toast
      mettreAJourCompteurPanier(); // Met à jour le compteur du panier
    }
  };
  document.addEventListener("click", panierClickListener);
}

function mettreAJourCompteurPanier() {
  const items = JSON.parse(localStorage.getItem(getPanierKey())) || [];
  const compteur = document.getElementById("panier-count");

  if (!compteur) return;

  const total = items.reduce((acc, item) => acc + item.qty, 0);
  compteur.textContent = total;

  if (total > 0) {
    compteur.style.display = "inline-block";
  } else {
    compteur.style.display = "none";
  }
}

function afficherToastPanier(nom, photo) {
  const toast = document.getElementById("toast-panier");
  const title = document.getElementById("toast-title");
  const text = document.getElementById("toast-text");
  const img = document.getElementById("toast-img");

  title.textContent = nom;
  img.src = window.serveurUrl + "photos/" + photo;

  toast.style.opacity = "1";
  toast.style.transform = "translateY(0)";
  toast.style.display = "flex";

  setTimeout(() => {
    toast.style.opacity = "0";
    toast.style.transform = "translateY(20px)";
    setTimeout(() => {
      toast.style.display = "none";
    }, 400);
  }, 3000);
}
function afficherMiniPanier() {
  const items = JSON.parse(localStorage.getItem(getPanierKey())) || [];
  const list = document.getElementById("liste-panier");
  const totalContainer = document.getElementById("total-panier");
  list.innerHTML = "";

  let total = 0;

  items.forEach((item) => {
    const li = document.createElement("li");
    li.classList.add("panier-item");
    const itemTotal = item.price * item.qty;
    total += itemTotal;

    li.innerHTML = `
      <div class="panier-article">
        <img src="${window.serveurUrl}photos/${item.photo}" alt="${
      item.name
    }" class="miniature-panier">
        <div>
          <strong>${item.name}</strong><br>
          Quantité : ${item.qty}<br>
          Prix total : ${itemTotal.toFixed(2)} $
        </div>
        <button class="remove-item" data-id="${
          item.id
        }" style="margin-left: auto;">❌</button>
      </div>
    `;

    list.appendChild(li);
  });

  totalContainer.innerHTML = `<strong>Total : ${total.toFixed(2)} $</strong>`;

  const boutonsSupprimer = list.querySelectorAll(".remove-item");
  boutonsSupprimer.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const index = e.target.getAttribute("data-index");
      supprimerArticleDuPanier(index);
      mettreAJourCompteurPanier(); // Met à jour le compteur du panier
    });
  });

  function supprimerArticleDuPanier(index) {
    const cart = JSON.parse(localStorage.getItem(getPanierKey())) || [];
    cart.splice(index, 1); // Supprime l'article à l'index donné
    localStorage.setItem(getPanierKey(), JSON.stringify(cart));
    afficherMiniPanier(); // Recharge la vue
  }
}

async function getArticlesMembre() {
  try {
    const response = await fetch(
      window.serveurUrl + "../routesArticles.php?action=getAllArticles"
    );
    const data = await response.json();

    if (Array.isArray(data.donnees)) {
      allArticles = data.donnees;
      allArticles.sort((a, b) => a.price - b.price);
      articlesFiltred = [...allArticles];
      renderArticlesMembre();
      setupPagination();
      miseAJourComptesCategories();
    }
  } catch (error) {
    console.error("Erreur lors de la récupération des articles :", error);
  }
}

function renderArticlesMembre() {
  const storeRow = document.querySelector("#membre-store .row");
  storeRow.innerHTML = ""; // Réinitialise le contenu de la grille d'articles

  const start = (pageActuelle - 1) * articlesParPage;
  const end = start + articlesParPage;
  const articlesToShow = articlesFiltred.slice(start, end);

  articlesToShow.forEach((article) => {
    const col = document.createElement("div");
    col.className = "col-md-4 col-xs-6";
    col.innerHTML = `
      <div class="product">
        <div class="product-img">
          <img src="${window.serveurUrl}photos/${article.photo}" alt="${
      article.name
    }">
        </div>
        <div class="product-body">
          <p class="product-category">${article.categorie}</p>
          <h3 class="product-name"><a href="#">${article.name}</a></h3>
          <h4 class="product-price">${article.price} $</h4>
          <div class="product-rating">
            ${generateStars(article.rating)}
          </div>
        </div>
        <div class="add-to-cart">
          <button class="add-to-cart-btn" 
            data-id="${article.id}" 
            data-name="${article.name}" 
            data-price="${article.price}" 
            data-photo="${article.photo}">
            <i class="fa fa-shopping-cart"></i> Acheter
          </button>
        </div>
      </div>
    `;
    storeRow.appendChild(col);
  });
}

function generateStars(rating) {
  let starsHTML = "";
  for (let i = 0; i < 5; i++) {
    starsHTML += `<i class="fa fa-star${i < rating ? "" : "-o"}"></i>`;
  }
  return starsHTML;
}

function gererFiltrage() {
  document
    .querySelectorAll('.checkbox-filter input[type="checkbox"]')
    .forEach((checkbox) => {
      checkbox.addEventListener("change", appliquerTousLesFiltres);
    });

  const priceMinInput = document.getElementById("price-min");
  const priceMaxInput = document.getElementById("price-max");
  if (priceMinInput && priceMaxInput) {
    priceMinInput.addEventListener("input", appliquerTousLesFiltres);
    priceMaxInput.addEventListener("input", appliquerTousLesFiltres);
  }
}

function setupPagination() {
  const pagination = document.querySelector(".store-pagination");
  pagination.innerHTML = "";

  const totalPages = Math.ceil(articlesFiltred.length / articlesParPage);

  for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement("li");
    li.innerHTML = `<span style="cursor:pointer;">${i}</span>`;
    if (i === pageActuelle) {
      li.classList.add("active");
    }
    li.addEventListener("click", (e) => {
      e.preventDefault();
      pageActuelle = i;
      renderArticlesMembre();
      setupPagination();
    });
    pagination.appendChild(li);
  }
}

function miseAJourComptesCategories() {
  const compteCategorie = {};

  Array.from(document.querySelectorAll(".count-products")).forEach((small) => {
    const categorie = small.dataset.category;
    compteCategorie[categorie] = 0;
  });

  allArticles.forEach((article) => {
    if (compteCategorie.hasOwnProperty(article.categorie)) {
      compteCategorie[article.categorie]++;
    }
  });

  Array.from(document.querySelectorAll(".count-products")).forEach((small) => {
    const categorie = small.dataset.category;
    small.textContent = `(${compteCategorie[categorie]})`;
  });
}

function appliquerTousLesFiltres() {
  const checkedCategories = Array.from(
    document.querySelectorAll(
      "#aside .checkbox-filter input[type='checkbox']:checked"
    )
  )
    .filter((cb) => cb.id.startsWith("category"))
    .map((cb) => cb.value);

  let prixMin = parseFloat(document.getElementById("price-min").value) || 0;
  let prixMax =
    parseFloat(document.getElementById("price-max").value) || Infinity;

  // Repartir de TOUS les articles
  articlesFiltred = allArticles.filter((article) => {
    const categoryMatch =
      checkedCategories.length === 0 ||
      checkedCategories.includes(article.categorie);
    const priceMatch = article.price >= prixMin && article.price <= prixMax;
    return categoryMatch && priceMatch;
  });

  // Toujours trier à la fin
  articlesFiltred.sort((a, b) => a.price - b.price);

  pageActuelle = 1;
  renderArticlesMembre();
  setupPagination();
}

async function afficherFacture() {
  const contenu = document.getElementById("contenu-principal");
  try {
    const response = await fetch(window.serveurUrl + "src/membre/facture.php");
    const html = await response.text();
    contenu.innerHTML = html;

    remplirFacture();
  } catch (error) {
    console.error("Une erreur s'est produite lors de la requête : ", error);
  }
}

function remplirFacture() {
  const panier = JSON.parse(localStorage.getItem(getPanierKey())) || [];

  const factureContenu = document.getElementById("facture-contenu");
  const totalElement = document.getElementById("facture-total");

  if (!factureContenu || !totalElement) return;

  let total = 0;
  let html = '<ul class="list-group mb-3">';

  panier.forEach((item) => {
    const subtotal = item.price * item.qty;
    total += subtotal;

    html += `
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">${item.qty} × ${item.name}</h6>
          <small class="text-muted">Prix unitaire: ${item.price.toFixed(
            2
          )} $</small>
        </div>
        <span class="text-muted">${subtotal.toFixed(2)} $</span>
      </li>
    `;
    html += "</ul>";

    factureContenu.innerHTML = html;
    totalElement.textContent = total.toFixed(2) + " $";

    const confirmerBtn = document.getElementById("confirmer-paiement");
    confirmerBtn.addEventListener("click", () => {
      localStorage.removeItem(getPanierKey());

      // Afficher un toast de confirmation
      const toast = document.getElementById("toast-confirmation");
      toast.style.opacity = "1";
      toast.style.transform = "translateY(0)";
      toast.style.display = "flex";

      setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.transform = "translateY(20px)";
        setTimeout(() => {
          toast.style.display = "none";
          document.querySelector("#home-bouton")?.click(); // Simuler clic vers "home"
        }, 400);
      }, 2000);
    });
  });

}

function setupListenersBoutonsPrix() {
  const priceMinInput = document.getElementById("price-min");
  const priceMaxInput = document.getElementById("price-max");

  const qtyUpMin = document.querySelector(".price-min .qty-up");
  const qtyDownMin = document.querySelector(".price-min .qty-down");
  const qtyUpMax = document.querySelector(".price-max .qty-up");
  const qtyDownMax = document.querySelector(".price-max .qty-down");

  if (qtyUpMin && qtyDownMin && qtyUpMax && qtyDownMax) {
    qtyUpMin.addEventListener("click", () => {
      priceMinInput.value = parseInt(priceMinInput.value || 0) + 100;
      appliquerTousLesFiltres();
    });

    qtyDownMin.addEventListener("click", () => {
      priceMinInput.value = Math.max(
        0,
        parseInt(priceMinInput.value || 0) - 100
      );
      appliquerTousLesFiltres();
    });

    qtyUpMax.addEventListener("click", () => {
      priceMaxInput.value = parseInt(priceMaxInput.value || 0) + 100;
      appliquerTousLesFiltres();
    });

    qtyDownMax.addEventListener("click", () => {
      priceMaxInput.value = Math.max(0, parseInt(priceMaxInput.value || 0) - 1);
      appliquerTousLesFiltres();
    });
  }
}

function setupListeners() {
  const boutonPaiement = document.getElementById("passer-au-paiement");

  if (boutonPaiement) {
    boutonPaiement.addEventListener("click", afficherFacture);
  }

  const logoBouton = document.getElementById("logo");
  if (logoBouton) {
    logoBouton.addEventListener("click", () => {
      window.location.href = window.serveurUrl + "index.php";
    });
  }

  document.addEventListener("click", async function (event) {
    const homeBouton = event.target.closest("#home-bouton");

    if (homeBouton) {
      event.preventDefault();

      try {
        const response = await fetch(
          window.serveurUrl + "src/membre/membre.php"
        );
        const html = await response.text();

        const parser = new DOMParser();
        const doc = parser.parseFromString(html, "text/html");
        const newBodyContent = doc.body.innerHTML;
        document.body.innerHTML = newBodyContent;
        toggleConnexionInscriptionButtons();
        $("#carousel-example-generic").carousel();
        articlesFeatured(allArticles);
        setupArticlesMembre();
        setupListeners();
        setupListenersBoutonsPrix();
        initPanier(); // Reinitialiser le panier
      } catch (error) {
        console.error("Erreur lors du retour à la boutique :", error);
      }
    }
  });
}

function toggleConnexionInscriptionButtons() {
   const connexionButton = document.querySelector(
          'a[data-target="#idConnexion"]'
        ).parentElement;
        const inscriptionButton = document.querySelector(
          'a[data-target="#idEnreg"]'
        ).parentElement;

        if (window.utilisateurRole === "M" || window.utilisateurRole === "A") {
          connexionButton.style.display = "none";
          inscriptionButton.style.display = "none";
        } else {
          connexionButton.style.display = "inline-block";
          inscriptionButton.style.display = "inline-block";
        }
}

export function setupArticlesMembre() {
  getArticlesMembre();
  gererFiltrage();
  setupListenersBoutonsPrix();
  setupListeners();
}

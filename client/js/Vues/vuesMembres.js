export function setupPanierInteraction() {
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

  document.addEventListener("click", function (event) {
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
  });
}

export function mettreAJourCompteurPanier() {
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

export function afficherToastPanier(nom, photo) {
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
export function afficherMiniPanier() {
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

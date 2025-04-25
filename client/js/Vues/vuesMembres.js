function setupPanierInteraction() {
  const panierButton = document.getElementById("panier-button");
  const miniPanier = document.getElementById("mini-panier");

  panierButton.addEventListener("click", (e) => {
    e.preventDefault();
    miniPanier.style.display =
      miniPanier.style.display === "none" ? "block" : "none";
  });

  // Fermer si on clique ailleurs
  document.addEventListener("click", (e) => {
    if (!miniPanier.contains(e.target) && e.target !== panierButton) {
      miniPanier.style.display = "none";
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  setupPanierInteraction();
});

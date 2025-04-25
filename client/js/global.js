import {
  getArticles,
  renderArticles,
  filterArticlesByCategory,
  chercherHeaderArticles,
} from "./Vues/vuesArticles.js";

//DOM manipulation

document.addEventListener("DOMContentLoaded", function () {
  toggleLogoutButton();
  togglePanierButton();
});

//fonction pour habiliter ou deshabiliter le bouton de deconnexion
function toggleLogoutButton() {
  const logoutButton = document.getElementById("logout-button");

  if (window.utilisateurRole === "M" || window.utilisateurRole === "A") {
    logoutButton.style.display = "inline-block"; // ou "block" selon ton layout
  } else {
    logoutButton.style.display = "none";
  }
}

function togglePanierButton() {
  const panierButton = document.getElementById("panier-button");

  if (window.utilisateurRole === "M" || window.utilisateurRole === "A") {
    panierButton.style.display = "inline-block"; // ou "block" selon ton layout
  } else {
    panierButton.style.display = "none";
  }
}

$(document).ready(function () {
  // Appel de la fonction pour charger les articles
  getArticles();
  //appel de la fonction pour charger les articles cherches dans le header
  chercherHeaderArticles();
  // Pour quand on clique sur un bouton du carrousel
  $(".carousel-control").on("mouseup", function () {
    $(this).blur();
  });
});
$(".products-slick").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  infinite: true,
  arrows: true,
  dots: false,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

window.filterArticlesByCategory = filterArticlesByCategory;

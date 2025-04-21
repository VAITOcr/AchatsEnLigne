import {
  getArticles,
  renderArticles,
  filterArticlesByCategory,
} from "./Vues/vuesArticles.js";

$(document).ready(function () {
  // Appel de la fonction pour charger les articles
  getArticles();
  // Pour quand on clique sur un bouton du carrousel
  $(".carousel-control").on("mouseup", function () {
    $(this).blur();
  });
});

window.filterArticlesByCategory = filterArticlesByCategory;

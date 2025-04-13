$(document).ready(function () {
  // Pour quand on clique sur un bouton du carrousel
  $(".carousel-control").on("mouseup", function () {
    $(this).blur();
  });
});

$(document).ready(function () {
  // Appel de la fonction pour charger les articles
  getArticles();
  // Pour quand on clique sur un bouton du carrousel
  $(".carousel-control").on("mouseup", function () {
    $(this).blur();
  });
  $(".products-slick").each(function () {
    var $this = $(this),
      $nav = $this.attr("data-nav");

    $this.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      infinite: true,
      speed: 300,
      arrows: true,
      appendArrows: $nav ? $($nav) : false,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });
});

function getArticles() {
  fetch("http://localhost/Projet/routesArticles.php?action=getAllArticles")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    });
}

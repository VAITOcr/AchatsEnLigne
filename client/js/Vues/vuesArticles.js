let allArticles = [];

document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll(".tab-link");

  links.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const category = link.getAttribute("data-category");
      filterArticlesByCategory(category);
      links.forEach((l) => l.parentElement.classList.remove("active"));
      link.parentElement.classList.add("active");
    });
  });
});

export async function getArticles() {
  const response = await fetch(
    window.serveurUrl + "../routesArticles.php?action=getAllArticles"
  );
  const data = await response.json();

  if (Array.isArray(data.donnees)) {
    allArticles = data.donnees;

    if (!window.utilisateurRole) {
      renderArticles(allArticles);
    }

    articlesFeatured(allArticles);
  }
}

export function renderArticles(articles) {
  const productsSlick = document.querySelector(".products-slick");
  if ($(productsSlick).hasClass("slick-initialized")) {
    $(productsSlick).slick("unslick");
  }
  productsSlick.innerHTML = "";

  articles.forEach((article) => {
    const articleElement = document.createElement("div");
    articleElement.classList.add("product-item", "text-center");

    let starsHTML = "";
    for (let i = 0; i < article.rating; i++) {
      starsHTML += `<i class="fa fa-star"></i>`;
    }

    let addToCartHTML = `
  <div class="add-to-cart">
    <button class="add-to-cart-btn" 
      data-photo="${article.photo}"
      data-id="${article.id}" 
      data-name="${article.name}" 
      data-price="${article.price}"
      ${
        window.utilisateurRole === "M"
          ? ""
          : 'disabled style="cursor: not-allowed; opacity: 0.5;" title="Connectez-vous en tant que membre pour ajouter au panier"'
      }>
      <i class="fa fa-shopping-cart"></i> Acheter
    </button>
  </div>`;

    articleElement.innerHTML = `
      <div class="product p-3 m-2 shadow-sm">
        <div class="product-img">
          <img class="img-fluid rounded" style="width: 200px; height: 200px;" src="${window.serveurUrl}photos/${article.photo}" alt="${article.name}">
        </div>
        <div class="product-body">
          <h3 class="product-name"><a href="#">${article.name}</a></h3>
          <h4 class="product-category">${article.categorie}</h4>
          <h4 class="product-price">${article.price} $</h4>
          <div class="product-rating">${starsHTML}</div>
        </div>
        ${addToCartHTML}
      </div>
    `;

    productsSlick.appendChild(articleElement);
  });

  $(".products-slick")
    .not(".slick-initialized")
    .slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      infinite: true,
      arrows: true,
      appendArrows: $("#slick-nav-1"),
      responsive: [
        { breakpoint: 1200, settings: { slidesToShow: 3 } },
        { breakpoint: 992, settings: { slidesToShow: 2 } },
        { breakpoint: 768, settings: { slidesToShow: 1 } },
      ],
    });
  $(".products-slick .slick-slide").css({
    "margin-left": "15px",
    "margin-bottom": "30px",
  });
}

export function filterArticlesByCategory(categorie) {
  if (categorie === "Tous") {
    renderArticles(allArticles);
  } else {
    const filteredArticles = allArticles.filter(
      (article) => article.categorie === categorie
    );
    renderArticles(filteredArticles);
  }
}

export function articlesFeatured(allArticles) {
  const featuredArticles = allArticles.filter(
    (article) => article.featured === "Y"
  );
  const carouselInner = document.querySelector(".carousel-inner");
  carouselInner.innerHTML = "";

  featuredArticles.forEach((article, index) => {
    const item = document.createElement("div");
    item.classList.add("item");
    if (index === 0) item.classList.add("active");

    item.innerHTML = `
      <div class="custom-cardIndex text-center">
        <img class="img-fluid rounded" style="width: 200px; height: 200px;" src="${
          window.serveurUrl
        }photos/${article.photo}" alt="${article.name}">
        <h3>${article.name}</h3>
        <p>${article.description.slice(0, 500)}...</p>
        <a href="#" class="btn btn-primary">Voir</a>
      </div>
    `;

    carouselInner.appendChild(item);
  });
}

export function chercherHeaderArticles() {
  const input = document.querySelector("#search-input");
  const form = document.querySelector("#search-form");

  input.addEventListener("input", (event) => {
    const query = input.value.trim().toLowerCase();

    if (query.length >= 2) {
      fetch(window.serveurUrl + "../routesArticles.php?action=getAllArticles")
        .then((response) => response.json())
        .then((data) => {
          if (Array.isArray(data.donnees)) {
            const resultatsFiltres = data.donnees.filter(
              (article) =>
                article.name.toLowerCase().includes(query) ||
                article.categorie.toLowerCase().includes(query)
            );
            renderArticles(resultatsFiltres);
          } else {
            console.error("Erreur lors de la recherche d'articles :", data);
          }
        })
        .catch((error) => {
          console.error("Erreur lors de la recherche d'articles :", error);
        });
    } else {
      renderArticles(allArticles); // Remet tous les articles si input vide
    }
  });

  form.addEventListener("submit", (event) => {
    event.preventDefault();
  });
}

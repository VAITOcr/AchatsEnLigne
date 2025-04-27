<?php
session_start();
define('SECURE_ACCESS', true); // Définir une constante pour sécuriser l'accès
require_once(__DIR__ . '/../config_paths.php');

$msg="";
if (isset($_GET['msg'])){
    $msg= $_GET['msg'];
}
// Redirection vers la page d'accueil si nest pas connecté
if (!isset($_SESSION['idm']) || $_SESSION['role'] !== 'M' || $_SESSION['agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy(); 
    header('Location: ../../../index.php?msg=' . urlencode("Session invalide."));
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <script>
  window.serveurUrl = "<?= $serveurUrl ?>";
   window.clientUrl = "<?= $clientUrl ?>";
</script>
  <link rel="stylesheet" href="<?= $clientUrl ?>utilitaires/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= $clientUrl ?>utilitaires/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?= $clientUrl ?>css/style.css" />
  <link rel="stylesheet" href="<?= $clientUrl ?>css/nouislider.min.css" />
  <link rel="stylesheet" href="<?= $clientUrl ?>utilitaires/css/slick.css" />
  <link rel="stylesheet" href="<?= $clientUrl ?>utilitaires/css/slick-theme.css" />

  <script src="<?= $clientUrl ?>utilitaires/jquery-3.7.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="module" src="<?= $clientUrl ?>js/global.js" ></script>
  <script src="<?= $clientUrl ?>js/requetes.js"></script>
  <script src="<?= $clientUrl ?>js/slick.min.js"></script>
  <script src="<?= $clientUrl ?>js/nouislider.min.js"></script>
</head>
  <body>
    <?php include($serveurPath . "src/membre/components/panier.php"); ?>
    <?php include($serveurPath . "src/components/headerIndex.php"); ?>

    <nav id="navigation">
      <?php include($serveurPath . "src/components/navBarIndex.php"); ?>
    </nav>

    <div class="container-fluid carouselIndex">
      <div class="row">
        <div class="col-md-12">
          <div
            id="carousel-example-generic"
            class="carousel slide"
            data-ride="carousel"
            data-interval="5000"
          >
            <!-- Slides -->
            <div class="carousel-inner" role="listbox"></div>

            <!-- Controls -->
            <a
              class="left carousel-control"
              href="#carousel-example-generic"
              role="button"
              data-slide="prev"
            >
              <span
                class="glyphicon glyphicon-chevron-left"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Précédent</span>
            </a>
            <a
              class="right carousel-control"
              href="#carousel-example-generic"
              role="button"
              data-slide="next"
            >
              <span
                class="glyphicon glyphicon-chevron-right"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Suivant</span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
   <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">

								<div class="input-checkbox">
									<input type="checkbox" id="category-1" value="Laptop">
									<label for="category-1">
										<span></span>
										Laptops
										<small class="count-products" data-category="Laptop">(0)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-2" value="Smartphone">
									<label for="category-2">
										<span></span>
										Smartphones
										<small class="count-products" data-category="Smartphone">(0)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-3" value="Moniteur">
									<label for="category-3">
										<span></span>
										Moniteurs
										<small class="count-products" data-category="Moniteur">(0)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-4" value="Accessories">
									<label for="category-4">
										<span></span>
										Accessories
										<small class="count-products" data-category="Accessories">(0)</small>
									</label>
								</div>

                <div class="input-checkbox">
                  <input type="checkbox" id="category-5" value="Autres">
                  <label for="category-5">
                    <span></span>
                    Autres
                    <small class="count-products" data-category="Autres">(0)</small>
                  </label>
                </div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

					
					</div>
					<!-- /ASIDE -->
					<!-- STORE -->
					<div id="membre-store" class="col-md-9">

						<!-- store products -->
						<div class="row">
							

						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty"></span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
    </div>

    <?php include($serveurPath . "src/components/footerIndex.php"); ?>
    <?php include($serveurPath . "src/components/modales.php"); ?>
    <div id="toast-panier" style="display:none; position: fixed; bottom: 20px; right: 20px; z-index: 9999; border-color: black; background-color: #c70027; color: white; border-radius: 10px; padding: 16px 20px; display: flex; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.2); opacity: 0; transition: opacity 0.4s ease, transform 0.4s ease;">
  <img id="toast-img" src="" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; margin-right: 15px;">
  <div>
    <strong id="toast-title" style="font-size: 16px;">Produit</strong><br>
    <span id="toast-text">Ajouté au panier</span>
  </div>
</div>

    <?php if (!empty($msg)): ?>
    <div
      id="custom-toast"
      class="alert alert-danger alert-dismissible fade in"
      role="alert"
      style="
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 9999;
        min-width: 320px;
      "
    >
      <span
        class="glyphicon glyphicon-exclamation-sign"
        aria-hidden="true"
        style="margin-right: 8px"
      ></span>
      <strong>Notification :</strong>
      <?= htmlspecialchars($msg); ?>
    </div>

    <script>
      setTimeout(function () {
        $("#custom-toast").fadeOut("slow", function () {
          $(this).alert("close");
        });
      }, 5000);
    </script>
    <?php endif; ?>

    <script>
      window.utilisateurRole = <?= isset($_SESSION['role']) ? json_encode($_SESSION['role']) : 'null' ?>;
      window.utilisateurId = <?= json_encode($_SESSION['idm']) ?>;
    </script>
  </body>
</html>

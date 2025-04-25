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
            data-interval="7000"
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
        <!-- conteneur -->
        <div class="container">
          <!-- ligne -->
          <div class="row">
            <!-- titre de la section -->
            <div class="col-md-12">
              <div class="section-title">
                <h3 class="title">Nouveaux produits MEMBRE</h3>
                <div class="section-nav">
                  <ul class="section-tab-nav tab-nav">
                    <li class="active">
                      <a class="tab-link" data-category="Tous" href="#">Tous</a>
                    </li>
                    <li>
                      <a class="tab-link" data-category="Smartphone" href="#"
                        >Smartphones</a
                      >
                    </li>
                    <li>
                      <a class="tab-link" data-category="Laptop" href="#"
                        >Laptops</a
                      >
                    </li>
                    <li>
                      <a class="tab-link" data-category="Autres" href="#"
                        >Autres</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- /titre de la section -->

            <!-- Onglets produits + slick -->
            <div class="col-md-12">
              <div class="row">
                <div class="products-tabs">
                  <!-- onglet -->
                  <div id="tab1" class="tab-pane active">
                    <div class="products-slick" data-nav="#slick-nav-1"></div>
                    <div id="slick-nav-1" class="products-slick-nav"></div>
                  </div>
                  <!-- /onglet -->
                </div>
              </div>
            </div>
            <!-- /Onglets produits + slick -->
          </div>
          <!-- /ligne -->
        </div>
        <!-- /conteneur -->
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

<?php
$msg="";
if (isset($_GET['msg'])){
    $msg= $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store APVinc</title>
    <link rel="stylesheet" href="client/utilitaires/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="client/css/style.css">
    <script src="client/utilitaires/jquery-3.7.1.min.js"></script>
    <script src="client/js/global.js"></script>
    
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-nav-perso">
        <div class="container-fluid">
            <a class="navbar-brand bi bi-house-door-fill" href="index.php"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand bi bi-person-lines-fill"  href="#contact"> Contactez-nous</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav nav-options-droite">
    <li class="nav-item ">
        <button class="btn btn-outline-dark ms-1" data-bs-toggle="modal" data-bs-target="#idEnreg">
            <i class="bi-person-plus me-1"></i>
            <span class="d-none d-md-inline">S'inscrire</span>
        </button>
        
    </li>
    <li class="nav-item ">
        <button class="btn btn-outline-dark ms-1" data-bs-toggle="modal" data-bs-target="#idConnexion">
            <i class="bi-box-arrow-in-right me-"></i>
            <span class="d-none d-md-inline ">Connexion</span>
        </button>
    </li>
</ul>


             <form class="d-flex ms-1">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
        </div>
    </nav>
    <!-- Header-->
        <header class="py-1 title-box header-perso">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder font-title texte-intro">Équipez votre bureau avec excellence !</h1>
        </div>
    </div>
</header>

         <!-- Heading Row-->
            <div class="row gx-2 gx-lg-5 align-items-center my-3 ms-1 custom-row">
                <div class="col-lg-7">
                    <img class="img-fluid rounded mb-lg-0" src="client/images/Logo.png" alt="..." /></div>
                <div class="col-lg-4 ">
                    <h1 class="">APVinc,
                        L’essentiel du bureau, à portée de clic !</h1>
                    <p>Découvrez APVinc, votre boutique en ligne dédiée aux fournitures et équipements de bureau. Que vous soyez une entreprise ou un particulier, nous vous proposons une large gamme de produits de qualité pour améliorer votre espace de travail. Commandez facilement et profitez d’une livraison rapide et fiable !</p>
                </div>
            </div>
        <!-- Section-->
        <section class="py-5 ">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5 product" >
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/cla.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Razer-Clavier</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5 product">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/File.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">USB</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5 product">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/Imp.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">BROTHER-IMPRIMANTE</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                    $25.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5 product">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/Kit.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">KIT CLAVIER-SOURIS</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    $40.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5 product">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/Mon .png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">ACER-144HZ</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                    $25.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5 product">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/stab.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">RAZER-STAND</h5>
                                    <!-- Product price-->
                                    $120.00 - $280.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5 product">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/Mousepad.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">MOUSEPAD</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5 product">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top image-perso" src="client/images/souris.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">SOURIS BUREAU</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    $40.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- Pour le toast -->
          <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Message</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div id="toastText" class="toast-body">
        <?= htmlspecialchars($msg) ?>
    </div>
  </div>
</div>

<!-- <script>
    document.addEventListener("DOMContentLoaded", () => {
        <?php if (!empty($msg)): ?>
            const toastElement = new bootstrap.Toast(document.getElementById("liveToast"));
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        <?php endif; ?>
    });
</script> -->
            
        </section>

       <footer class="py-3 bg-dark footer" id="contact">
    <div class="container">
        <div class="row">
            <!-- Texte de copyright aligné à gauche -->
            <div class="col-md-4 text-md-start text-center">
                <p class="text-white m-0">
                    Copyright &copy; APVinc 2025. Tous droits réservés.  
                </p>
                <p class="text-white m-0">
                    Toute reproduction, distribution ou modification sans autorisation préalable est strictement interdite.
                </p>
            </div>

            <!-- Contact au centre -->
            <div class="col-md-4 text-md-center text-center">
                <p class="text-white m-0">Contactez-nous :</p>
                <p class="text-white m-0">contact@apvinc.com</p>
                <p class="text-white m-0">+1 514 514 5142</p>
            </div>

            <!-- Réseaux sociaux à droite -->
            <div class="col-md-4 text-md-end text-center">
                <p class="text-white m-0">Suivez-nous :</p>
                <a href="#" class="me-2">
                    <img src="client/images/facebook.png" alt="Facebook" width="40" >
                </a>
                <a href="#" class="me-2">
                    <img src="client/images/twitter.png" alt="Twitter" width="40" >
                </a>
                <a href="#">
                    <img src="client/images/linkedin.png" alt="LinkedIn" width="40" >
                </a>
            </div>
        </div>
    </div>
</footer>

        
    <div class="container">  
        
        <!-- Modal pour enregistrer membre -->
        <div class="modal fade" id="idEnreg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enregistrer membre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="idFormEnreg" action="serveur/src/controleurs/controleurMembre.php" method="POST"
                            enctype="multipart/form-data" class="row" onSubmit="return validerFormEnreg();" autocomplete="off">
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control is-valid" id="prenom" name="prenom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control is-valid" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-12">
                                <label for="courriel" class="form-label">Courriel</label>
                                <input type="email" class="form-control is-valid" id="courriel" name="courriel" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pass" class="form-label">Mot de passe</label>
                                <!-- pattern="^[A-Za-z0-9_\$#\-]{6,10}$" -->
                                <input type="password" class="form-control is-valid" id="mdp" name="mdp" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cpass" class="form-label">Confirmer mot de passe</label>
                                <input type="password" class="form-control is-valid" id="mdpc" name="mdpc" required>
                                <span id="msgPass"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select class="form-select" id="sexe" name="sexe" aria-describedby="validationServer04Feedback">
                                    <option selected disabled value="">Choisir</option>
                                    <option value="F">Féminin</option>
                                    <option value="M">Masculin</option>
                                    <option value="A">Autres</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="daten" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control is-valid" id="daten" name="daten">
                            </div>
                            <div class="col-md-12">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" class="form-control is-valid" id="photo" name="photo">
                            </div>
                            <input type="hidden" name="action" value="enregistrer">
                            <div class="col-3 btn-bottom-perso">
                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                            </div>
                            <div class="col-3 btn-bottom-perso">
                                <button class="btn btn-secondary" type="reset">Vider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin du modal pour enregistrer membre -->

        <!-- Modal connexion -->
        <div class="modal fade" id="idConnexion" tabindex="-1" aria-labelledby="ModalConnexionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalConnexionLabel">Connexion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" id="idFormConnexion" action="serveur/src/connexion/connexion.php" method="POST" autocomplete="off">
                        <div class="col-md-12">
                            <label for="courriel" class="form-label">Courriel</label>
                            <input type="email" class="form-control" id="courrielco" name="courrielco" required>
                        </div>
                        <div class="col-md-12">
                            <label for="pass" class="form-label">Mot Passe</label>
                            <!-- pattern="[A-Za-z0-9_\$#\-]{6,10}$" -->
                            <input type="password" class="form-control" id="mdpco" name="mdpco" required>
                        </div>
                        <div class="col-3 btn-bottom-perso">
                            <button class="btn btn-primary" type="submit">Connexion</button>
                        </div>
                        <div class="col-3 btn-bottom-perso">
                            <button class="btn btn-secondary" type="reset">Vider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin du modal connexion -->
        
</body>

</html>



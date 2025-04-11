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

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="client/utilitaires/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="client/utilitaires/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="client/css/style.css"/>
    
    <script src="client/utilitaires/jquery-3.7.1.min.js"></script>
    <script src="client/utilitaires/js/bootstrap.bundle.min.js"></script>
    <script src="client/js/global.js"></script>
    <script src="client/js/requetes.js"></script>
</head>
<body>
    <?php include("serveur/src/components/headerIndex.php"); ?>
    
    <nav id="navigation">
        <?php include("serveur/src/components/navBarIndex.php"); ?>
    </nav>

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
    
    </div>
    
<?php if (!empty($msg)): ?>
<div id="custom-toast" class="alert alert-danger alert-dismissible fade in" role="alert" 
     style="position: fixed; top: 20px; left: 20px; z-index: 9999; min-width: 320px;">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right: 8px;"></span>
    <strong>Notification :</strong> <?= htmlspecialchars($msg); ?>
</div>

<script>
    // Disparition automatique après 5 secondes
    setTimeout(function () {
        $('#custom-toast').fadeOut('slow', function () {
            $(this).alert('close');
        });
    }, 5000);
</script>
<?php endif; ?>


</body>
</html>



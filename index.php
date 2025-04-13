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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="client/js/global.js"></script>
    <script src="client/js/requetes.js"></script>
</head>
<body>
    <?php include("serveur/src/components/headerIndex.php"); ?>
    
    <nav id="navigation">
        <?php include("serveur/src/components/navBarIndex.php"); ?>
    </nav>


        <div class="container carouselIndex">
            <div class="row">
                <div class="col-md-12 ">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="7000">
        
                    <!-- Indicateurs -->
                    <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                        <!-- Slides -->
                        <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <div class="custom-cardIndex text-center">
                            <h3>Produit 1</h3>
                            <p>Une description  pour le produit 1.</p>
                            <a href="#" class="btn btn-primary">Acheter</a>
                            </div>
                        </div>

                        <div class="item">
                            <div class="custom-cardIndex text-center">
                            <h3>Produit 2</h3>
                            <p>Quelques infos sur le produit 2.</p>
                            <a href="#" class="btn btn-success">Voir plus</a>
                            </div>
                        </div>

                        <div class="item">
                            <div class="custom-cardIndex text-center">
                            <h3>Produit 3</h3>
                            <p>Description du produit 3 avec une action.</p>
                            <a href="#" class="btn btn-warning">Découvrir</a>
                            </div>
                        </div>
                        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Précédent</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Suivant</span>
        </a>

      </div>
    </div>
  </div>
</div>


    <?php include("serveur/src/components/footerIndex.php"); ?>

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



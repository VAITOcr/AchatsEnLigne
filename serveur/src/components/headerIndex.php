<?php
include_once __DIR__ . '/../config_paths.php';
?>

<!-- Header-->
        <header>
    <header>
			
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +1 514 514 5142</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> APVinc@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 222 rue des bois</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#" data-toggle="modal" data-target="#idConnexion"><i class="fa fa-user-o"></i> Connexion</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#idEnreg"><i class="fa fa-user-plus"></i> Inscription</a></li>
						<li><a href="<?= $serveurUrl ?>src/connexion/deconnecter.php" id="logout-button"><i class="fa fa-sign-out"></i> Déconnexion</a></li>
					</ul>
				</div>
			</div>

            <div id="header">
				
				<div class="container">
					
					<div class="row">
						
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="<?= $clientUrl ?>images/logoNew.png" alt="">
								</a>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="header-search">
								<form id="search-form">
									<input id="search-input" class="input" placeholder="Rechercher ici">
									<button class="search-btn">Chercher</button>
								</form>
							</div>
						</div>
                        <div class="col-md-3 clearfix">
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- /HEADER -->
<?php

define('SECURE_ACCESS', true); // Définir une constante pour sécuriser l'accès

require_once(__DIR__ . '/../config_paths.php');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
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


		

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone">
							</div>
							
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="tel" placeholder="Telephone">
									</div>
								</div>
							</div>
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details facture-contenu">
						 <h4>Total : <span id="facture-total">0 $</span></h4>
                         <div id="facture-contenu"></div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Transfert bancaire
								</label>
								
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Carte de Crédit/ Debit
								</label>
								
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal
								</label>
								
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								Je suis d'accord avec <a href="#"> les terms & conditions</a>
							</label>
						</div>
						<a href="#" id="confirmer-paiement" class="primary-btn order-submit">Confirmer le paiement</a>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		
	</body>
</html>

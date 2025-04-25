<?php




?>


<div id="mini-panier">
  <h4>Votre panier</h4>
  <ul id="liste-panier">
  </ul>
  <div class="text-right">
    <strong>Total : <span id="total-panier">0</span> $</strong><br>
    <a href="#" class="btn btn-primary btn-sm mt-2">Passer au paiement</a>
  </div>
  <div id="mini-panier" style="display: none; position: absolute; top: 60px; right: 20px; background: #fff; border: 1px solid #ccc; padding: 15px; width: 350px; max-height: 400px; overflow-y: auto; box-shadow: 0 0 10px rgba(0,0,0,0.2); z-index: 999;">
  <h4>Mon panier</h4>
  <ul id="liste-panier" style="list-style: none; padding: 0;"></ul>
  <div id="total-panier" style="margin-top: 10px; font-size: 16px;"></div>
  <button id="close-panier" class="btn btn-danger btn-sm" style="margin-top: 10px;">Fermer</button>
</div>
</div>
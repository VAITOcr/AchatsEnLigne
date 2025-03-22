function montreToast(msg) {
  // Récupérer l'élément du texte du toast
  let toastText = document.getElementById("toastText");
  toastText.innerHTML = msg; // Mettre le message dans le toast

  // Créer l'instance du toast avec Bootstrap et l'afficher
  let toastElement = document.getElementById("liveToast");
  let toast = new bootstrap.Toast(toastElement);
  toast.show(); // Afficher le toast
}

function getMessageFromUrl() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get("msg");
}

// Attendre que le DOM soit complètement chargé
document.addEventListener("DOMContentLoaded", function () {
  const msg = getMessageFromUrl();
  if (!msg) {
    return;
  }
  montreToast(msg);
});

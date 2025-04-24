let listeDesArticles;

const reqListeDesArticles = async () => {
  try {
    const response = await fetch(
      window.serveurUrl + "serveur/src/articles/listerArticles.php"
    );
    const data = await response.json();
    listeDesArticles = data;
  } catch (error) {
    console.error("Une erreur s'est produite lors de la requête : ", error);
  }
};

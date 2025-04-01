let listeDesArticles;

const reqListeDesArticles = async () => {
    const url='serveur/src/controleurs/obtenirListeArticles.php';
    try {
        const reponse = await fetch(url);
        if (reponse.ok) {
            listeDesArticles = await reponse.json();
            alert('listeDesArticles : ' + JSON.stringify(listeDesArticles));
        } else {
            throw new Error(reponse.status + ' ' + reponse.statusText);
        }
    } catch (e) {
        console.error(e);
    }
};
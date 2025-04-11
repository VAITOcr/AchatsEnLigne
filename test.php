<?php
require_once('serveur/src/articles/DAO_Articles.php');
require_once('serveur/src/articles/Article.php');

// Créer une instance de DAO_Articles
$daoArticles = new DAO_Articles();

// Test de la fonction getAllArticles
$articles = $daoArticles->getAllArticles();
echo "<h2>Liste des articles:</h2>";
foreach ($articles as $article) {
    echo "ID: " . $article->id . " | Nom: " . $article->name . " | Description: " . $article->description . " | Prix: " . $article->price . "<br>";
}

// Test de la fonction getArticleById
$idToTest = 1; // Change l'ID ici pour tester un autre article
$article = $daoArticles->getArticleById($idToTest);
if ($article) {
    echo "<h2>Article avec ID " . $idToTest . ":</h2>";
    echo "ID: " . $article->id . " | Nom: " . $article->name . " | Description: " . $article->description . " | Prix: " . $article->price . "<br>";
} else {
    echo "Aucun article trouvé pour l'ID " . $idToTest . "<br>";
}


// Test de la mise à jour d'un article
echo "<h2>Modification d'un article:</h2>";
$daoArticles->updateArticle($idToTest, 'Article Modifié', 'Description modifiée', 45);
$articleModifie = $daoArticles->getArticleById($idToTest);
echo "Article modifié : " . $articleModifie->name . " | " . $articleModifie->description . " | " . $articleModifie->price . "<br>";

// Test de la suppression d'un article
echo "<h2>Suppression de l'article avec ID $idToTest:</h2>";
$daoArticles->deleteArticle($idToTest);
$articleSupprime = $daoArticles->getArticleById($idToTest);
if (!$articleSupprime) {
    echo "Article avec ID $idToTest supprimé.<br>";
} else {
    echo "L'article existe toujours: " . $articleSupprime->name . "<br>";
}
?>

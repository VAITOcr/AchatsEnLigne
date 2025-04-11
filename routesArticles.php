<?php

require_once('serveur/src/articles/ControleurArticles.php');
header('Content-Type: application/json');

$instanceControleurArticles = ControleurArticles::getInstance();


//routes
$action= $_POST['action'];

switch ($action) {
    case 'getAllArticles':
        $instanceControleurArticles->afficherArticles();
        break;
    case 'getArticleById':
        $id = $_POST['id'];
        $instanceControleurArticles->afficherArticle($id);
        break;
    case 'addArticle':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $instanceControleurArticles->ajouterArticle($id, $name, $description, $price);
        break;
    case 'updateArticle':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $instanceControleurArticles->modifierArticle($id, $name, $description, $price);
        break;
    case 'deleteArticle':
        $id = $_POST['id'];
        $instanceControleurArticles->supprimerArticle($id);
        break;
    default:
        break;
}


?>
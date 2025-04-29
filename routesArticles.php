<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once('serveur/src/articles/ControleurArticles.php');
header('Content-Type: application/json');

$instanceControleurArticles = ControleurArticles::getInstance();


//routes
$action= $_POST['action'] ?? $_GET['action'] ?? null;

if ($action) {
    switch ($action) {
        case 'getAllArticles':
            $instanceControleurArticles->afficherArticles();
            break;
        case 'getArticleById':
            $id = $_POST['id'] ?? $_GET['id'] ?? null;
            if ($id) {
                $instanceControleurArticles->afficherArticle($id);
            } else {
                echo json_encode(["error" => "ID manquant."]);
            }
            break;
        case 'addArticle':
            if (
                isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['categorie']) &&
                isset($_FILES['photo'])
            ) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $categorie = $_POST['categorie'];
                $photo = $_FILES['photo'];
                $featured = $_POST['featured'] ?? 'N';
                $rating = $_POST['rating'] ?? 0;

                $instanceControleurArticles->ajouterArticle($id, $name, $description, $price, $photo, $categorie, $featured, $rating);
            } else {
                echo json_encode(["error" => "Données manquantes pour ajouter un article."]);
            }
            break;
        case 'updateArticle':
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $price = $_POST['price'] ?? null;
            $photo = $_FILES['photo'] ?? null;
            $categorie = $_POST['categorie'] ?? null;
            $featured = $_POST['featured'] ?? 'N';
            $rating = $_POST['rating'] ?? 0;

            if ($id && $name && $description && $price && $photo && $categorie && $featured && $rating) {
                $instanceControleurArticles->modifierArticle($id, $name, $description, $price, $photo, $categorie, $featured, $rating);
            } else {
                echo json_encode(["error" => "Données manquantes pour mettre à jour l'article."]);
            }
            break;
        case 'deleteArticle':
            $id = $_POST['id'] ?? $_GET['id'] ?? null;
            if ($id) {
                $instanceControleurArticles->supprimerArticle($id);
            } else {
                echo json_encode(["error" => "ID manquant pour supprimer l'article."]);
            }
            break;
        default:
            echo json_encode(["error" => "Action inconnue."]);
            break;
    }
} else {
    echo json_encode(["error" => "Action manquante."]);
}


?>
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
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $price = $_POST['price'] ?? null;

            if ($id && $name && $description && $price) {
                $instanceControleurArticles->ajouterArticle($id, $name, $description, $price);
            } else {
                echo json_encode(["error" => "Données manquantes pour ajouter un article."]);
            }
            break;
        case 'updateArticle':
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $price = $_POST['price'] ?? null;

            if ($id && $name && $description && $price) {
                $instanceControleurArticles->modifierArticle($id, $name, $description, $price);
            } else {
                echo json_encode(["error" => "Données manquantes pour mettre à jour l'article."]);
            }
            break;
        case 'deleteArticle':
            $id = $_POST['id'] ?? null;
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
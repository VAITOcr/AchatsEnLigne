<?php

require_once('DAO_Articles.php');

class ControleurArticles{
    private $daoArticles;

    public function __construct(){
        $this->daoArticles = new DAO_Articles();
    }

    // Singleton pour s'assurer qu'il n'y a qu'une seule instance de ControleurArticles
    // Utilisé pour éviter de créer plusieurs instances de la classe
    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new ControleurArticles();
        }
        return $instance; 
    }

    public function afficherArticles(){
        $articles = $this->daoArticles->getAllArticles();
        header ('content-type: application/json');
        echo json_encode($articles); // Renvoie la liste des articles au format JSON
    }

    public function afficherArticle($id){
        $article = $this->daoArticles->getArticleById($id); // Récupère un article par son ID
        header ('content-type: application/json');
        echo json_encode($article);  // Renvoie l'article au format JSON
    }

    // Ajoute un article à la base de données
    public function ajouterArticle($id, $name, $description, $price){
        // Vérifie si l'article existe déjà
        $articleExist = $this->daoArticles->getArticleById($id);
        if ($articleExist) {
            $msg = "L'article existe déjà.";
            return;
        }
        // Ajoute l'article à la base de données
       if ($this->daoArticles->addArticle($id, $name, $description, $price)) {
            $msg = "L'article a été ajouté avec succès !";
        } else {
            $msg = "Une erreur s'est produite lors de l'ajout de l'article.";
            // exit ("Erreur lors de l'ajout de l'article : " . $msg);  
        }
    }

    // Met à jour un article dans la base de données
    public function modifierArticle($id, $name, $description, $price){
        // Vérifie si l'article existe
        $articleExist = $this->daoArticles->getArticleById($id);
        if (!$articleExist) {
            $msg = "L'article n'existe pas.";
            return;
        }elseif ($this->daoArticles->updateArticle($id, $name, $description, $price)) {
            $msg = "L'article a été modifié avec succès !";
        } else {
            $msg = "Une erreur s'est produite lors de la modification de l'article.";
        }
    }

    public function supprimerArticle($id){
        // Vérifie si l'article existe
        $articleExist = $this->daoArticles->getArticleById($id);
        if (!$articleExist) {
            $msg = "L'article n'existe pas.";
            return;
        } elseif ($this->daoArticles->deleteArticle($id)) {
            $msg = "L'article a été supprimé avec succès !";
            header('Location: index.php?msg='.urlencode($msg));
        } else {
            $msg = "Une erreur s'est produite lors de la suppression de l'article.";
            header('Location: index.php?msg='.urlencode($msg));
        }
    }
}

?>
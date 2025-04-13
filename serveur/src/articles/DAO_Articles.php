<?php

require_once(__DIR__.'/../connexion/connexion.php');
require_once('Article.php');

class DAO_Articles{
    private static $connexion = null;
    private $instance;
    private static $objReponse=["etat"=>true, "message"=>"", "donnees"=>[]];

    public function __construct(){}

    static function getInstance(): PDO {
        if (self::$instance == null) {
            self::$instace = new DAO_Articles();
        }
        return self::$instance;
    }

    public function getAllArticles(): array {
        try {
            // Connexion à la base de données
            $connexion = Connexion::getConnexion();
            // Préparation de la requête SQL
            $stmt = $connexion->prepare("SELECT * FROM articles");
            // Exécuter la requête SQL
            $stmt->execute();
            // Récupérer les données retournées par MySQL
            self::$objReponse["donnees"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer l'erreur
            self::$objReponse["etat"] = false;
            self::$objReponse["message"] = "Erreur lors de la récupération des articles: " . $e->getMessage();
        }
        return self::$objReponse;
    }

    //recuperer un article par ID
    public function getArticleById(Article $article): ?Article {
        // Connexion à la base de données
        $connexion = Connexion::getConnexion();
        // Préparation de la requête SQL
        $stmt = $connexion->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->execute(['id' => $article->getId()]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Article($row['id'], $row['name'], $row['description'], $row['price']) : null;
    }

    //ajouter un article
    public function addArticle(Article $article){
        
        // Connexion à la base de données
        $connexion = Connexion::getConnexion();

        // Préparation de la requête SQL
        $stmt = $connexion->prepare("INSERT INTO articles (id, name, description, price) VALUES (:id, :name, :description, :price)");
        // Exécuter la requête SQL
        $stmt->execute(['id' => $article->getId(), 'name' => $article->getName(), 'description' => $article->getDescription(), 'price' => $article->getPrice()]);
        
    }

    // mettre a jour un article
    public function updateArticle(Article $article){
        // Connexion à la base de données
        $connexion = Connexion::getConnexion();
        // Préparation de la requête SQL
        $stmt = $connexion->prepare("UPDATE articles SET name = :name, description = :description, price = :price WHERE id = :id");
        // Exécuter la requête SQL
        $stmt->execute(['id' => $article->getId(), 'name' => $article->getName(), 'description' => $article->getDescription(), 'price' => $article->getPrice()]);
    }

    // supprimer un article
    public function deleteArticle(Article $article){
        // Connexion à la base de données
        $connexion = Connexion::getConnexion();
        // Préparation de la requête SQL
        $stmt = $connexion->prepare("DELETE FROM articles WHERE id = :id");
        // Exécuter la requête SQL
        $stmt->execute(['id' => $article->getId()]);
    }
}
?>

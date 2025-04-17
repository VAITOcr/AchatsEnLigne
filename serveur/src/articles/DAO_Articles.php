<?php

require_once(__DIR__.'/../connexion/connexion.php');
require_once('Article.php');

class DAO_Articles{
    private static $connexion = null;
    private static $instance;
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
    public function getArticleById($id): ?Article {
        // Connexion à la base de données
        $connexion = Connexion::getConnexion();
        // Préparation de la requête SQL
        $stmt = $connexion->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Article($row['id'], $row['name'], $row['description'], $row['price']) : null;
    }

    //ajouter un article dans la base de données
    public function addArticle ($id, $name, $description, $price): void {
        // Créer un nouvel objet Article
        $article = new Article($id, $name, $description, $price);
        // Vérifier si l'article existe déjà
        $existingArticle = $this->getArticleById($article->getId());
        if ($existingArticle) {
            self::$objReponse["etat"] = false;
            self::$objReponse["message"] = "L'article existe déjà.";
            return;
        }
        // Vérifier si l'ID est valide
        if (!filter_var($article->getId(), FILTER_VALIDATE_INT)) {
            self::$objReponse["etat"] = false;
            self::$objReponse["message"] = "L'ID de l'article doit étre un nombre entier.";
            return;
        }
        // Connexion à la base de données
        $connexion = Connexion::getConnexion();
        // Préparation de la requête SQL
        $stmt = $connexion->prepare("INSERT INTO articles (id, name, description, price) VALUES (:id, :name, :description, :price)");
        // Exécuter la requête SQL
        $stmt->execute(['id' => $article->getId(), 'name' => $article->getName(), 'description' => $article->getDescription(), 'price' => $article->getPrice()]);
        self::$objReponse["etat"] = true;
        self::$objReponse["message"] = "L'article a été ajouté avec succès !";
        self::$objReponse["donnees"] = $article;
       
    }

    // mettre a jour un article
    public function updateArticle($id, $name, $description, $price): void {
    // Vérifier si l'article existe
    $article = $this->getArticleById($id);
    if (!$article) {
        self::$objReponse["etat"] = false;
        self::$objReponse["message"] = "L'article n'existe pas.";
        return;
    }
    // Mettre à jour les données de l'article
    $article->setName($name);
    $article->setDescription($description);
    $article->setPrice($price);
    // Connexion à la base de données
    $connexion = Connexion::getConnexion();
    // Préparation de la requête SQL
    $stmt = $connexion->prepare("UPDATE articles SET name = :name, description = :description, price = :price WHERE id = :id");
    // Exécuter la requête SQL
    $stmt->execute(['name' => $article->getName(), 'description' => $article->getDescription(), 'price' => $article->getPrice(), 'id' => $article->getId()]);
    self::$objReponse["etat"] = true;
    self::$objReponse["message"] = "L'article a été modifié avec succès !";
    self::$objReponse["donnees"] = $article;
    }
    

    // supprimer un article
    public function deleteArticle($id): void {
    // Vérifier si l'article existe
    $article = $this->getArticleById($id);
    if (!$article) {
        self::$objReponse["etat"] = false;
        self::$objReponse["message"] = "L'article n'existe pas.";
        return;
    }
    // Connexion à la base de données
    $connexion = Connexion::getConnexion();
    // Préparation de la requête SQL
    $stmt = $connexion->prepare("DELETE FROM articles WHERE id = :id");
    // Exécuter la requête SQL
    $stmt->execute(['id' => $article->getId()]);
    self::$objReponse["etat"] = true;
    self::$objReponse["message"] = "L'article a été supprimé avec succès !";
    self::$objReponse["donnees"] = $article;    
}

}
?>

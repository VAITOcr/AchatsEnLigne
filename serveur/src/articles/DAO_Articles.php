<?php

require_once(__DIR__.'/../connexion/connexion.php');
require_once('Article.php');

class DAO_Articles{
    private $pdo;

    public function __construct(){
        $this->pdo = Connexion::getConnexion();
    }

    public function getAllArticles(){
        $stmt = $this->pdo->query("SELECT * FROM articles");
        $articles=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $articles[] = new Article($row['id'], $row['name'], $row['description'], $row['price']);
        }
        return $articles;
    }

    //recuperer un article par ID
    public function getArticleById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Article($row['id'], $row['name'], $row['description'], $row['price']) : null;
    }

    //ajouter un article
    public function addArticle($id, $name, $description, $price){
        $stmt = $this->pdo->prepare("INSERT INTO articles (id, name, description, price) VALUES (:id, :name, :description, :price)");
        return $stmt->execute(['id' => $id, 'name' => $name, 'description' => $description, 'price' => $price]);
    }

    // mettre a jour un article
    public function updateArticle($id, $name, $description, $price){
        $stmt = $this->pdo->prepare("UPDATE articles SET name = :name, description = :description, price = :price WHERE id = :id");
        $stmt->execute(['id' => $id, 'name' => $name, 'description' => $description, 'price' => $price]);
    }

    // supprimer un article
    public function deleteArticle($id){
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
?>

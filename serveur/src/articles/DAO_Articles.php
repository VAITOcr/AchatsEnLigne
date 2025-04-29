<?php

require_once(__DIR__.'/../connexion/connexion.php');
require_once('Article.php');

class DAO_Articles {
    private static $objReponse = ["etat" => true, "message" => "", "donnees" => []];

    public function getAllArticles(): array {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("SELECT * FROM articles");
            $stmt->execute();
            self::$objReponse["donnees"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            self::$objReponse["etat"] = false;
            self::$objReponse["message"] = "Erreur lors de la récupération des articles: " . $e->getMessage();
        }
        return self::$objReponse;
    }

    public function getArticleById($id): ?Article {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("SELECT * FROM articles WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? new Article($row['id'], $row['name'], $row['description'], $row['price'], $row['photo'], $row['featured'], $row['rating'], $row['categorie']) : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function addArticle($id, $name, $description, $price, $photo, $categorie, $featured = 'N', $rating = 0): bool {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("INSERT INTO articles (id, name, description, price, photo, featured, rating, categorie) VALUES (:id, :name, :description, :price, :photo, :featured, :rating, :categorie)");
            $stmt->execute([
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'photo' => $photo,
                'featured' => $featured,
                'rating' => $rating,
                'categorie' => $categorie
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateArticle($id, $name, $description, $price, $photo, $categorie, $featured = 'N', $rating = 0): bool {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("UPDATE articles SET name = :name, description = :description, price = :price, photo = :photo, featured = :featured, rating = :rating, categorie = :categorie WHERE id = :id");
            $stmt->execute([
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'photo' => $photo,
                'featured' => $featured,
                'rating' => $rating,
                'categorie' => $categorie
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteArticle($id): bool {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("DELETE FROM articles WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>

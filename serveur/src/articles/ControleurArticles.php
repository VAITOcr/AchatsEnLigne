<?php

require_once('DAO_Articles.php');

class ControleurArticles {
    private $daoArticles;

    public function __construct() {
        $this->daoArticles = new DAO_Articles();
    }

    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new ControleurArticles();
        }
        return $instance;
    }

    public function afficherArticles() {
        $articles = $this->daoArticles->getAllArticles();
        header('Content-Type: application/json');
        echo json_encode($articles);
    }

    public function afficherArticle($id) {
        $article = $this->daoArticles->getArticleById($id);
        header('Content-Type: application/json');
        echo json_encode($article);
    }

    public function ajouterArticle($id, $name, $description, $price, $photo, $categorie, $featured = 'N', $rating = 0) {
        $articleExist = $this->daoArticles->getArticleById($id);
        if ($articleExist) {
            echo json_encode(['success' => false, 'message' => "L'article existe déjà."]);
            return;
        }

        if (!isset($photo) || $photo['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => "Aucune image valide reçue."]);
            return;
        }

        $allowedTypes = ['image/jpeg', 'image/png'];
        $mimeType = mime_content_type($photo['tmp_name']);

        if (!in_array($mimeType, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => "Format d'image invalide. (JPG/PNG requis)"]);
            return;
        }

        $extension = $mimeType === 'image/png' ? 'png' : 'jpg';
        $nomFichierPhoto = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($name)) . '.' . $extension;
        $destination = __DIR__ . '/../../photos/' . $nomFichierPhoto;

        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            echo json_encode(['success' => false, 'message' => "Échec du téléchargement de l'image."]);
            return;
        }

        $result = $this->daoArticles->addArticle($id, $name, $description, $price, $nomFichierPhoto, $categorie, $featured, $rating);
        if ($result) {
            echo json_encode(['success' => true, 'message' => "L'article a été ajouté avec succès !"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Une erreur s'est produite lors de l'ajout de l'article."]);
        }
    }

    public function modifierArticle($id, $name, $description, $price, $photo, $categorie, $featured = 'N', $rating = 0) {
    $articleExist = $this->daoArticles->getArticleById($id);
    if (!$articleExist) {
        echo json_encode(['success' => false, 'message' => "L'article n'existe pas."]);
        return;
    }

    // Vérifie si une nouvelle image est fournie
    if (isset($photo) && $photo['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        $mimeType = mime_content_type($photo['tmp_name']);

        if (!in_array($mimeType, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => "Format d'image invalide."]);
            return;
        }

        $extension = $mimeType === 'image/png' ? 'png' : 'jpg';
        $nomFichierPhoto = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($name)) . '.' . $extension;
        $destination = __DIR__ . '/../../photos/' . $nomFichierPhoto;

        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            echo json_encode(['success' => false, 'message' => "Erreur de téléchargement de la photo."]);
            return;
        }
    } else {
        // Pas de nouvelle image : conserver l'ancienne
        $nomFichierPhoto = $articleExist->getPhoto();
    }

    $result = $this->daoArticles->updateArticle($id, $name, $description, $price, $nomFichierPhoto, $categorie, $featured, $rating);
    echo json_encode([
        'success' => $result,
        'message' => $result ? "L'article a été modifié avec succès !" : "Erreur lors de la modification."
    ]);
}

    public function supprimerArticle($id) {
        $articleExist = $this->daoArticles->getArticleById($id);
        if (!$articleExist) {
            echo json_encode(['success' => false, 'message' => "L'article n'existe pas."]);
            return;
        }

        $result = $this->daoArticles->deleteArticle($id);
        if ($result) {
            echo json_encode(['success' => true, 'message' => "L'article a été supprimé avec succès !"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Une erreur s'est produite lors de la suppression de l'article."]);
        }
    }
}

?>

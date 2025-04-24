<?php
require_once(__DIR__ . '/../connexion/connexion.php');

$conn = Connexion::getConnexion();

if (isset($_GET['q'])) {
    $motCle = "%" . $_GET['q'] . "%";

    $sql = "SELECT * FROM articles WHERE name LIKE ? OR categorie LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$motCle, $motCle]);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultats);
}
?>

<?php
require "config.php";

if (!isset($_GET['id'])) {
    die("Produit introuvable");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM Produit WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    die("Produit introuvable");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Détails</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2><?= $produit['nom'] ?></h2>
<p>Prix: <?= $produit['prix'] ?> DH</p>
<p>Description: <?= $produit['description'] ?></p>
<p>Catégorie: <?= $produit['categorie'] ?></p>

<a href="catalogue.php">Retour</a>

</body>
</html>
<?php
require "config.php";

$sql = "SELECT * FROM Produit";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catalogue</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Catalogue des produits</h2>

<?php if (isset($_GET['success'])): ?>
    <p class="success">Produit ajouté avec succès</p>
<?php endif; ?>

<a href="ajouter-produit.php">Ajouter un produit</a>

<div class="container">
<?php foreach ($produits as $p): ?>
    <div class="card">
        <h3><?= $p['nom'] ?></h3>
        <p>Prix: <?= $p['prix'] ?> DH</p>
        <a href="details.php?id=<?= $p['id'] ?>">Détails</a>
    </div>
<?php endforeach; ?>
</div>

</body>
</html>
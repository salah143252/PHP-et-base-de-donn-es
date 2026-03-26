<?php
require "config.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];

    if (empty($nom)) $errors[] = "Nom obligatoire";
    if (empty($prix)) $errors[] = "Prix obligatoire";
    if (!is_numeric($prix)) $errors[] = "Prix invalide";
    if (empty($description)) $errors[] = "Description obligatoire";
    if (empty($categorie)) $errors[] = "Catégorie obligatoire";

    if (empty($errors)) {
        $sql = "INSERT INTO Produit (nom, prix, description, categorie)
                VALUES (:nom, :prix, :description, :categorie)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'prix' => $prix,
            'description' => $description,
            'categorie' => $categorie
        ]);

        header("Location: catalogue.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter produit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Ajouter un produit</h2>

<?php foreach ($errors as $e): ?>
    <p class="error"><?= $e ?></p>
<?php endforeach; ?>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom"><br><br>
    <input type="text" name="prix" placeholder="Prix"><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>
    <input type="text" name="categorie" placeholder="Catégorie"><br><br>

    <button type="submit">Ajouter</button>
</form>

</body>
</html>
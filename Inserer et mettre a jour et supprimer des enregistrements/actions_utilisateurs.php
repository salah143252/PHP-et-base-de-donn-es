<?php
require '../Chapitre 1 – Connexion à une base de données avec PDO/connexion.php';

try {
    $stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, email) VALUES (:nom, :email)");
    $stmt->execute([
        'nom' => 'Charlie',
        'email' => 'charlie@test.com'
    ]);
    echo "Utilisateur ajouté avec succès.<br>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
$stmt = $pdo->prepare("UPDATE Utilisateur SET email = :email WHERE id = :id");
$stmt->execute([
    'email' => 'charlie.new@test.com',
    'id' => 3
]);
echo "Utilisateur mis à jour.<br>";
$stmt = $pdo->prepare("DELETE FROM Utilisateur WHERE id = :id");
$stmt->execute(['id' => 3]);
echo "Utilisateur supprimé.<br>";
echo $stmt->rowCount() . " ligne(s) affectée(s).";

?>
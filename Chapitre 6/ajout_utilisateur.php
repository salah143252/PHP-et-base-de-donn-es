<?php
require '../Chapitre 1 – Connexion à une base de données avec PDO/connexion.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    try {
        $stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, email) VALUES (:nom, :email)");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email
        ]);
        echo "Utilisateur ajouté avec succès.";
    } catch (PDOException $e) {
        file_put_contents('../Chapitre 4 – Gérer les erreurs avec try/catch et exceptions PDO/erreurs.log', $e->getMessage(), FILE_APPEND);
        echo "Une erreur est survenue. Contactez l’administrateur.";
    }
}
?>
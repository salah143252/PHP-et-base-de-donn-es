<?php
require 'config.php';
$erreur = false;

if(isset($_POST['ok']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $age = $_POST['age'];


        if(empty($name)||  empty($email)||  empty($telephone) || empty($age))
            {
                echo "tout les champ est obligatoir";
                $erreur = true;
            }
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                echo "email invalide";
                $erreur = true;
            }
            if($age < 18)
            {
                echo "age invalide";
                $erreur = true;
            }
        }
        if($erreur == false)
        {
            $sql = "INSERT INTO utilisateur (name, email, telephone, age)
                    VALUES (:name,:email,:telephone,:age)";

            $stm = $pdo->prepare($sql);

            $stm->execute([
                "name" => $name,
                "email" => $email,
                "telephone" => $telephone,
                "age" => $age
            ]);
            echo "utilisateur bien ajouter";

            header("Location: select.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>ADD</h3>
    <form method = "POST">
        <input type="text" name = "name" placeholder = "name"><br><br>
        <input type="email" name = "email" placeholder = "email"><br><br>
        <input type="tel" name = "telephone" placeholder = "telephone"><br><br>
        <input type="number" name = "age" placeholder = "age"><br><br>
        

        <button type = "submit" name = "ok">ADD</button>
    </form>
</body>
</html>
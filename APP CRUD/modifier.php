<?php
require "config.php";
$erreur=false;
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT*FROM utilisateur WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([

        "id"=>$id
    ]);
    $user=$stmt->FETCH(pdo::FETCH_ASSOC);
    if(!$user){
        echo"user introuvable";
    }
}
if(isset($_POST['modifier'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $telephone=$_POST['telephone'];
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
if($erreur == false){
    $sql=" UPDATE utilisateur
    SET name=:name,
    email=:email,
    age=:age,
    telephone=:telephone
    WHERE id=:id
    ";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        "id"=>$id,
        "name"=>$name,
        "telephone"=>$telephone,
        "age"=>$age,
        "email"=>$email
    ]);
    header("location:select.php");

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
    <h2>modifier data base</h2>
    <?php if($user) {?>
        <form method="POST">
            <label >id</label>
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'])?>">
            <label >name</label>
            <input type="text" name="name"value="<?= htmlspecialchars($user['name'])?>" >
            <label >email</label>
            <input type="email" name="email"value="<?= htmlspecialchars($user['email'])?> ">
            <label >telephone</label>
            <input type="tel" name="telephone"value="<?= htmlspecialchars($user['telephone'])?>" >
            <label >age</label>
            <input type="number" name="age"value="<?= htmlspecialchars($user['age'])?>" >
            <button type="submit" name="modifier">modifier</button>



        </form>




        <?PHP } ?>
    
</body>
</html>
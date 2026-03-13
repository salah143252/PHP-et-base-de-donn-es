<?php
require "config.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM utilisateur WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt ->execute([
        "id" => $id
    ]);
    header("location:select.php");
    exit;
}






?>
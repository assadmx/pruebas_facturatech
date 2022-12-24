<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM palindromo WHERE id_palindromo = :id");
    $query->bindParam(":id", $data);
    $query->execute();
    echo "ok";
?>
<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM ordenarray WHERE id_ordenarray = :id");
    $query->bindParam(":id", $data);
    $query->execute();
    echo "ok";
?>
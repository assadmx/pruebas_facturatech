<?php

function palindromo($cadena)
{
    
    $input = explode(" ", strtolower($cadena));
    //echo "esta es la salida";
    //var_dump($input); die();
    $inputdepurado="";
    foreach($input as $c)
    {
        trim($c);
        $inputdepurado .= $c; 
    }
    if($inputdepurado == strrev($inputdepurado))
    {
        return "Es Palindromo";
    }
    else {
        return "No es Palindromo, sorry";
    }
}

if (isset($_POST)) {
    $palindromo = $_POST['palindromo'];
    $salida=palindromo($palindromo);
    require("conexion.php");
    if (empty($_POST['idp'])){
        $query = $pdo->prepare("INSERT INTO palindromo (valor_usuario,valor_salida) VALUES (:vu, :vs)");
        $query->bindParam(":vu", $palindromo);
        $query->bindParam(":vs", $salida);
        $query->execute();
        $pdo = null;
        echo "ok";
    }else{
        $id = $_POST['idp'];
       // echo "<script>console.log("."holamundo".");</script>";
        $query = $pdo->prepare("UPDATE palindromo SET valor_usuario = :vu, valor_salida = :vs WHERE id_palindromo = :id");
        $query->bindParam(":vu", $palindromo);
        $query->bindParam(":vs", $salida);
        $query->bindParam("id", $id);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
}

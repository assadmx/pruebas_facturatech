<?php

function burbuja($arreglo_usuario)
{
    $arreglo=explode(",",$arreglo_usuario);
    $longitud = count($arreglo);
    for ($i = 0; $i < $longitud; $i++) {
        for ($j = 0; $j < $longitud - 1; $j++) {
            if ($arreglo[$j] > $arreglo[$j + 1]) {
                $temporal = $arreglo[$j];
                $arreglo[$j] = $arreglo[$j + 1];
                $arreglo[$j + 1] = $temporal;
            }
        }
    }
    return $arreglo;
}

if (isset($_POST)) {
    $lista = $_POST['burbuja'];
    $salida=implode(",",burbuja($lista));
    require("conexion.php");
    if (empty($_POST['idp'])){
        $query = $pdo->prepare("INSERT INTO ordenarray (valor_usuario,valor_salida) VALUES (:vu, :vs)");
        $query->bindParam(":vu", $lista);
        $query->bindParam(":vs", $salida);
        $query->execute();
        $pdo = null;
        echo "ok";
    }else{
        $id = $_POST['idp'];
       // echo "<script>console.log("."holamundo".");</script>";
        $query = $pdo->prepare("UPDATE ordenarray SET valor_usuario = :vu, valor_salida = :vs WHERE id_ordenarray = :id");
        $query->bindParam(":vu", $lista);
        $query->bindParam(":vs", $salida);
        $query->bindParam("id", $id);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
}

<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM palindromo ORDER BY id_palindromo DESC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM palindromo WHERE id_palindromo LIKE '%".$data."%' OR valor_usuario LIKE '%".$data."%' OR valor_salida LIKE '%".$data."%'");
    $consulta->execute();
}
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $data) {
    echo "<tr>
            <td>" . $data['id_palindromo'] . "</td>
            <td>" . $data['valor_usuario'] . "</td>
            <td>" . $data['valor_salida'] . "</td>
            <td>
                <button type='button' class='btn btn-success' onclick=Editar('" . $data['id_palindromo'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminar('" . $data['id_palindromo'] . "')>Eliminar</button>
            </td>        
        </tr>";
}

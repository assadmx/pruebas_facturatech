<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM ordenarray ORDER BY id_ordenarray DESC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM ordenarray WHERE id_ordenarray LIKE '%".$data."%' OR valor_usuario LIKE '%".$data."%' OR valor_salida LIKE '%".$data."%'");
    $consulta->execute();
}
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $data) {
    echo "<tr>
            <td>" . $data['id_ordenarray'] . "</td>
            <td>" . $data['valor_usuario'] . "</td>
            <td>" . $data['valor_salida'] . "</td>
            <td>
                <button type='button' class='btn btn-success' onclick=Editar('" . $data['id_ordenarray'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminar('" . $data['id_ordenarray'] . "')>Eliminar</button>
            </td>        
        </tr>";
}

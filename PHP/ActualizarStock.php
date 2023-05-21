<?php

session_start();
require('Conexion.php');

$disco_id = $_POST['parametro1'];
$cantidad = $_POST['parametro2'];

$consultaSQL = "CALL actualizarDiscoExistencia(" . $disco_id . ", " . $cantidad . ");";
mysqli_query($conexion, $consultaSQL);

$response = ['status' => 'success', 'message' => 'Procedimiento almacenado ejecutado correctamente'];
echo json_encode($response);

?>


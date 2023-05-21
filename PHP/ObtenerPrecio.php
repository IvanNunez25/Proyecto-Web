<?php

session_start();
require('Conexion.php');
$disco_id = $_POST['parametroDiscoPrecio'];

function regresarPrecio($dis_id, $con)
{
    $consultaSQL = "SELECT obtenerPrecio(".$dis_id.") AS disco_precioUnitario;";
    $existe = mysqli_query($con, $consultaSQL);
    $precio = mysqli_fetch_all($existe, MYSQLI_ASSOC);

    return $precio;
}

$precio = regresarPrecio($disco_id, $conexion);

echo json_encode($precio);

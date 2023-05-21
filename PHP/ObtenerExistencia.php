<?php

// session_start();
// require('Conexion.php');
// $disco_id = $_POST['parametroDiscoID'];

// function regresarExistencia($dis_id, $con)
// {
//     $consultaSQL = "SELECT obtenerExistencia(".$dis_id.") AS disco_existencia;";
//     $existe = mysqli_query($con, $consultaSQL);
//     $stock = mysqli_fetch_all($existe, MYSQLI_ASSOC);

//     return $stock;
// }

// $existencia = regresarExistencia($disco_id, $conexion);

// echo json_encode($existencia);

// <?php
session_start();
require('Conexion.php');
$disco_id = $_POST['parametroDiscoID'];

function regresarExistencia($dis_id, $con)
{
    $consultaSQL = "SELECT obtenerExistencia('".$dis_id."') AS disco_existencia;";
    $existe = mysqli_query($con, $consultaSQL);
    $stock = mysqli_fetch_all($existe, MYSQLI_ASSOC);

    return $stock;
}

$existencia = regresarExistencia($disco_id, $conexion);

echo "<script> alert(".$existencia.");</script>";


echo json_encode($existencia);


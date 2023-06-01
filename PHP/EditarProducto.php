<?php

require('Conexion.php');

$ID = $_GET["id"];

$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$precio = $_POST['precio'];
$stock = $_POST['existencia'];

mysqli_query($conexion, "UPDATE discos 
                         SET dis_nombre = '".$nombre."', 
                             dis_flanzamiento = '".$fecha."',
                             dis_precioUnitario = '".$precio."',
                             dis_existencia = '".$stock."'
                         WHERE dis_id = '" . $ID . "'");


echo '<script> window.location.href="../captura.html" </script>';

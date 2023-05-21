<?php

require('Conexion.php');

$total = $_POST['parametroTotal'];
$productos = $_POST['parametroNumProductos'];
$id = $_POST['parametroID'];

mysqli_query($conexion, "UPDATE ventas SET vta_numProductos = '".$productos."' WHERE vta_id = '".$id."';");
mysqli_query($conexion, "UPDATE ventas SET vta_total = '".$total."' WHERE vta_id = '".$id."';");

?>
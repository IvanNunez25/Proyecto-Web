<?php

session_start();
require('Conexion.php');

$cantidad = $_POST['parametroCantidad'];
$precio = $_POST['parametroPrecio'];
$subtotal = $_POST['parametroSubTotal'];
$disco_id = $_POST['parametroIDDisco'];
$venta_id = $_POST['parametroIDVenta'];

mysqli_query($conexion, "INSERT INTO detalles (det_cantidad, det_precioActual, det_subtotal, vta_id, dis_id) VALUES ('".$cantidad."', '".$precio."', '".$subtotal."',  '".$venta_id."', '".$disco_id."');");

?>
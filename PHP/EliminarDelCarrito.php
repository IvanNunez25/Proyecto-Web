<?php

session_start();
require('Conexion.php');

$pedido_id = $_POST['parametroPedidoID'];

$consultaSQL = "DELETE FROM carritos_discos WHERE (cardis_id = '".$pedido_id."');";
mysqli_query($conexion, $consultaSQL);

?>


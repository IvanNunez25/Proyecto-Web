<?php

require('Conexion.php');

$id = $_GET['id'];

$sql = "DELETE FROM discos WHERE dis_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id); // "i" indica que el valor es un entero
$stmt->execute();

echo '<script> window.location.href="../captura.html" </script>';

?>

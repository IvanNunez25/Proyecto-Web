<?php

require('Conexion.php');

$id = $_GET['id'];

$sql = "DELETE FROM carritos_discos WHERE cardis_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id); // "i" indica que el valor es un entero
$stmt->execute();

echo '<script> window.location.href="../perfil.php" </script>';

?>

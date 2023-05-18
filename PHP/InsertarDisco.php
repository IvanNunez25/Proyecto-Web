<?php

session_start();
require('Conexion.php');

$disco = $_POST['disco'];
$fecha = $_POST['fecha'];
$precio = $_POST['precio'];
$existencia = $_POST['existencia'];
$artista = $_POST['artista'];

mysqli_query($conexion, "CALL insertarDisco('".$_SESSION['administrador']."', '".$disco."', '".$fecha."',  '".$precio."', '".$existencia."', '".$artista."');");

echo '<script> window.location.href="../captura.html" </script>';
?>
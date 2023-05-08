<?php

session_start();
require('Conexion.php');

$disco = $_POST['disco'];
$fecha = $_POST['fecha'];
$precio = $_POST['precio'];
$artista = $_POST['artista'];

//mysqli_query($conexion, "CALL insertarArtista('".$_SESSION['administrador']."', '".$artista."', '".$tipo."');");

echo '<script> window.location.href="../captura.html" </script>';
?>
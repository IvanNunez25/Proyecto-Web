<?php

session_start();
require('Conexion.php');

$artista = $_POST['artista'];
$tipo = $_POST['tipo'];

mysqli_query($conexion, "CALL insertarArtista('".$_SESSION['administrador']."', '".$artista."', '".$tipo."');");

echo '<script> window.location.href="../captura.html" </script>';

?>
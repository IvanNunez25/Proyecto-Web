<?php

session_start();

include('Conexion.php');
if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['administrador'])){
    $consulta = mysqli_query($conexion, "CALL cerrarSesion('".$_SESSION['administrador']."');;");
} 

session_destroy();

header("Location: ../index.php");

?>
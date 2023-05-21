<?php

session_start();
require('Conexion.php');

mysqli_query($conexion, "CALL insertarVenta('".$_SESSION['usuario']."');");


?>
<?php 

$dbhost = "localhost";
$dbname = "tienda";
$dbuser = "root";
$dbpass = "strongPassword";
$dbport = "3306";

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) or die ("Problemas con la conexión");

if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "error de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}

?>
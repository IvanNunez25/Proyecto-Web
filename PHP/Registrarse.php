<?php

session_start();
require 'Conexion.php';
include "../miCuenta.html";

$usuario = $_POST["usuario"];
$passw = $_POST["contra"];

if(($usuario != "") && ($passw != "")){
    
    $consulta = "SELECT COUNT(cte_nombre) AS num_clientes FROM clientes WHERE ('".$usuario."' = cte_nombre)";
    $resultado = mysqli_query($conexion, $consulta);

    $numUsuarios = mysqli_fetch_array($resultado)[0];

    if($numUsuarios < 1){

        $_SESSION['usuario'] = $usuario;
        $sql = "INSERT INTO clientes (cte_nombre, cte_password, cte_fcreacion) VALUES ('".$usuario."', aes_encrypt('".$passw."', 'claveContrasenia'), SYSDATE());";       
        mysqli_query($conexion, $sql);
       
        $sql = "SELECT obtenerNuevoClienteID('".$usuario."') AS cliente_id;";
        $ejecucion = mysqli_query($conexion, $sql);
        $cte_id = mysqli_fetch_array($ejecucion)[0];

        $sql = "SELECT crearCarrito('".$cte_id."')";
        $ejecucion = mysqli_query($conexion, $sql);
        $car_id = mysqli_fetch_array($ejecucion)[0];
        
        $_SESSION['carrito_id'] = $car_id;
        
        mysqli_query($conexion, "CALL actualizarClienteCarrito('".$car_id."', '".$cte_id."');");
        
        mysqli_close($conexion);

        header("Location: ../perfil.php");

    } else {

        session_destroy();
        echo '<script language="javascript"> alert("El nombre de usuario ya está registrado"); window.location.href="../miCuenta.html" </script>';
        
    }    

} else {

    session_destroy();
    echo '<script language="javascript"> alert("Por favor, complete los campos"); window.location.href="../miCuenta.html" </script>';

}


?>
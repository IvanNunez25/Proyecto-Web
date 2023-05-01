<?php

session_start();

require 'Conexion.php';
include "../miCuenta.html";

$usuario = $_POST["user"];
$password = $_POST["pass"];

if($conexion){

    $consulta = mysqli_query($conexion, "SELECT (aes_decrypt(cte_password, 'claveContrasenia')) AS cte_password FROM clientes WHERE (cte_nombre = '".$usuario."');");

    $consultaString = mysqli_fetch_assoc($consulta);
    $contrasenia = $consultaString['cte_password'];
    
    if(strcmp($contrasenia, $password) == 0  && ($usuario != "" || $password != "")){        
        $_SESSION['usuario'] = $usuario;
        header("Location: ../perfil.php");
    } else {        
        session_destroy();
        echo '<script language="javascript"> alert("Error de autentificacion"); window.location.href="../miCuenta.html" </script>';
    }

    mysqli_close($conexion);

}

?>
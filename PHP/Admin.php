<?php

session_start();

require 'Conexion.php';
include "../administrador.html";

$usuario = $_POST["usuario"];
$password = $_POST["password"];

if($conexion){

    $consulta = mysqli_query($conexion, "SELECT (aes_decrypt(usr_password, 'claveContrasenia')) AS usr_password FROM usuarios WHERE (usr_nombre = '".$usuario."');");

    $consultaString = mysqli_fetch_assoc($consulta);
    $contrasenia = $consultaString['usr_password'];
    
    if(strcmp($contrasenia, $password) == 0  && ($usuario != "" || $password != "")){        
        $_SESSION['administrador'] = $usuario;
        header("Location: ../menuadministrador.php");
    } else {        
        session_destroy();
        echo '<script language="javascript"> alert("Error de autentificacion"); window.location.href="../administrador.html" </script>';
    }

    mysqli_close($conexion);

}

?>
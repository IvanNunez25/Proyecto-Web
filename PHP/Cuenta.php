<?php

session_start();

if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['usuario'])){
    header("Location: ../perfil.php");
} else{
    header("Location: ../miCuenta.html");    
}
    
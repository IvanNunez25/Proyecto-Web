<?php

session_start();

if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['administrador'])){
    header("Location: ../menuadministrador.php");
} else{
    header("Location: ../administrador.html");    
}
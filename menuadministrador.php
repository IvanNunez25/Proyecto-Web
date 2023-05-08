<?php
    session_start();

    require('PHP/Conexion.php');

    if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['administrador'])){
        
    } else{
        header("Location: administrador.html");    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;1,200&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="CSS/menuadmin.css">

    <title>Administración</title>    
</head>
<body>

    <header>
        <nav>
            <a href="index.php">
                <!-- <i class="material-icons">home</i> -->
                <img class="logo" src="Imagenes/home-alt-2-regular-36.png" alt="">
            </a>

            <ul class="enlaces-menu">
                <li><a href="menuadministrador.php">Estadisticas</a></li>
                <li><a href="captura.html">Ingresar Datos</a></li>
                <li><a href="PHP/CerrarSesion.php">Cerrar Sesión</a></li>
            </ul>

            <button class="ham" type="button">
                <span class="br-1"></span>
                <span class="br-2"></span>
                <span class="br-3"></span>
            </button>
        </nav>
    </header>

    <script src="JavaScript/menuham.js"></script>
    
    <script>
        
    </script>

</body>
</html>
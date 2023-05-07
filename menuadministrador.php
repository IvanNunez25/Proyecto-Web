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
                <li><a href="">Estadisticas</a></li>
                <li><a href="">Ingresar Datos</a></li>
                <li><a href="">Cerrar Sesión</a></li>
            </ul>

            <button class="ham" type="button">
                <span class="br-1"></span>
                <span class="br-2"></span>
                <span class="br-3"></span>
            </button>
        </nav>
    </header>

    <script src="JavaScript/menuham.js"></script>
    
    <!-- <nav class="sidebar close">           
        <div class='menu-bar'>
            <div class='menu'> 
                <ul class='menu-links'>
                    <li class='nav-link' title='Home'>                
                        <div class='icon'>
                            <i class="material-icons">home</i>
                        </div>                              
                    </li>

                    <li class='nav-link' title='Estadisticas'>                
                        <div class='icon'>
                            <i class="material-icons">trending_up</i>    
                        </div>                                                     
                    </li>

                    <li class='nav-link' title='Ingresar Datos'>                
                        <div class='icon'>
                            <i class="material-icons">edit</i>     
                        </div>                                    
                    </li>
              
                    <div class='lout Fnav'>
                        <li class='nav-link ' title='Cerrar Sesion'>                
                            <div class='icon'>
                                <button onclick="location.href='PHP/CerrarSesion.php'">
                                    <i class="material-icons">logout</i>
                                </button>                                
                            </div>                                    
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </nav> -->
<!-- 
    <div class="contenido">
        <p class="mensaje">Hola,</p>
        
        <div class="estadisticas">
            <p class="titulo">Estadisticas</p>
        </div>
    </div> -->

</body>
</html>
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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="CSS/menuadmin.css">

    <title>Document</title>    
</head>
<body>
    
    <nav class="sidebar close">           
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
    </nav>

</body>
</html>
<?php
    session_start();

    require('PHP/Conexion.php');

    if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['usuario'])){
        
    } else{
        header("Location: miCuenta.html");    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preload" href="CSS/normalize.css" as="style">
    <link rel="style" href="CSS/normalize.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;1,200&display=swap" rel="stylesheet">

    <!-- <link rel="preload" href="CSS/miCuenta.css" as = "style">
    <link rel="stylesheet" href="CSS/miCuenta.css"> -->
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="CSS/datatable.css">


    <link rel="preload" href="CSS/estilos.css" as = "style">
    <link rel="stylesheet" href="CSS/estilos.css">
    
    <title>Mi cuenta</title>
</head>
<body>

    <div class="mc-encabezado">         
        <div class="perfil-encabezado">
            <div class="perfil-imagen"></div>
            <div class="perfil-nombre">
                <h2> 
                    <?php
                        echo $_SESSION['usuario'];
                    ?> 
                </h2> 
            </div>            
        </div>

        <div class="perfil-encabezado">
            <a href="PHP/CerrarSesion.php">Cerrar Sesión</a>
        </div>

    </div>

    <div class="navegacion"> <!-- ------------------------------ -->
        <nav class="barra-navegacion">
            <a href="index.php">Inicio</a>            
            <a href="catalogo.php">Catalogo</a>
            <a href="#">Contacto</a>                        
            <a href="#">Sobre Nosotros</a>
        </nav>
    </div>

    <div class="mc-carrito">
        <div class="carrito contenedor sombra">
            <h3>Productos de tu carrito:
                <?php
                    $sql = "SELECT obtenerNuevoClienteID('".$_SESSION['usuario']."') AS cliente_id;";
                    $ejecucion = mysqli_query($conexion, $sql);
                    $cte_id = mysqli_fetch_array($ejecucion)[0];
            
                    $sql = "SELECT obtenerNumProductos('".$cte_id."')";
                    $ejecucion = mysqli_query($conexion, $sql);
                    $car_productos = mysqli_fetch_array($ejecucion)[0];

                    echo $car_productos;

                    
                    // if($car_productos > 0){

                    //     $consultaSQL = "SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario, cd.cardis_cantidad
                    //                     FROM artistas as a
                    //                     JOIN discos as d ON (a.art_id = d.art_id)
                    //                     JOIN carritos_discos as cd ON (d.dis_id = cd.dis_id)
                    //                     JOIN carritos as c ON (cd.car_id = c.car_id)
                    //                     JOIN clientes as cl ON (c.cte_id = cl.cte_id)
                    //                     WHERE cl.cte_nombre = '".$_SESSION['usuario']."';";
                    //     $ejecucion = mysqli_query($conexion, $consultaSQL); 

                    //     echo '<br><br><table class="carrito-productos">';

                    //     echo "<thead>";
                    //     echo "<tr>";
                    //     echo "<td> ARTISTA </td>";
                    //     echo "<td> PRODUCTO </td>";
                    //     echo "<td> PRECIO UNITARIO </td>";
                    //     echo "<td> CANTIDAD </td>";
                    //     echo "<td style='text-align: center'> TOTAL </td>";
                    //     echo "</tr>";
                    //     echo "</thead>";

                    //     $total = 0;
                    //     while($resultado = mysqli_fetch_assoc($ejecucion)){
                    //         echo "<tr>";
                    //         echo "<td>" . $resultado['art_nombre'] . "</td>";
                    //         echo "<td>" . $resultado['dis_nombre'] . "</td>";
                    //         echo "<td>" . $resultado['dis_precioUnitario'] . "</td>";
                    //         echo "<td>" . $resultado['cardis_cantidad'] . "</td>";                            
                    //         echo "<td style='text-align: center'>$" . $resultado['dis_precioUnitario'] * $resultado['cardis_cantidad'] . "</td>";

                    //         $total += $resultado['dis_precioUnitario'] * $resultado['cardis_cantidad'];
                    //         echo "</tr>";
                    //     }

                    //     echo "<tr>";
                    //     echo "<td></td>";
                    //     echo "<td></td>";
                    //     echo "<td></td>";
                    //     echo "<td></td>";
                    //     echo "<td style='text-align: center'> Total: $" . $total . "</td>";
                    //     echo "</tr>";

                    //     echo "</table>";
                    // }
                ?>
            </h3>

            <div class="datatable-container">

                <div class="header-tools">
                    <div class="tools">
                        <ul>
                            <li>
                                <span><input type="checkbox"></span>
                            </li>
                            <li>
                                <button><i class="material-icons">add_circle</i></button>
                            </li>
                            <li>
                                <button><i class="material-icons">edit</i></button>
                            </li>
                            <li>
                                <button><i class="material-icons">delete</i></button>
                            </li>
                            <li>
                                <button><i class="material-icons">share</i></button>
                            </li>
                        </ul>
                    </div>

                    <div class="search">
                        <input type="text" name="" id="" class="search-input">
                    </div>
                </div>  

                <table id="datatable" class="datatable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Artista</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>                    
                        <?php 

                            if($car_productos > 0){

                                $consultaSQL = "SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario, cd.cardis_cantidad
                                                FROM artistas as a
                                                JOIN discos as d ON (a.art_id = d.art_id)
                                                JOIN carritos_discos as cd ON (d.dis_id = cd.dis_id)
                                                JOIN carritos as c ON (cd.car_id = c.car_id)
                                                JOIN clientes as cl ON (c.cte_id = cl.cte_id)
                                                WHERE cl.cte_nombre = '".$_SESSION['usuario']."';";
                                $ejecucion = mysqli_query($conexion, $consultaSQL); 

                                $total = 0;
                                while($resultado = mysqli_fetch_assoc($ejecucion)){
                                    echo "<tr>";
                                    echo "<td class='table-checkbox'><input type='checkbox' name='' id=''></td>";
                                    echo "<td>" . $resultado['art_nombre'] . "</td>";
                                    echo "<td>" . $resultado['dis_nombre'] . "</td>";
                                    echo "<td>" . $resultado['dis_precioUnitario'] . "</td>";
                                    echo "<td>" . $resultado['cardis_cantidad'] . "</td>";                            
                                    echo "<td style='text-align: center'>$" . $resultado['dis_precioUnitario'] * $resultado['cardis_cantidad'] . "</td>";

                                    $total += $resultado['dis_precioUnitario'] * $resultado['cardis_cantidad'];
                                    echo "</tr>";
                                }

                            }
                        ?>
                    </tbody>
                </table>

                <div class="footer-tools">
                    <div class="list-items">
                        Show
                        <select name="n-entries" id="n-entries" class="n-entries">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                        </select>
                    </div>

                <div class="pages">
                    <ul>
                        <li><span class="active">1</span></li>
                        <li><button>2</button></li>
                        <li><button>3</button></li>
                        <li><button>4</button></li>
                        <li><span>...</span></li>
                        <li><button>9</button></li>
                        <li><button>10</button></li>
                    </ul>
                </div>
            </div>
        </div>
    
        </div>

        <div class="carrito contenedor sombra">
            <h3>Insignias:</h3>
        </div>
    </div>

    <div class="pie-pagina"> <!-- ------------------------------ -->

        <div class="infoPie">
            <h3>Ubicación</h3>
            <p> 
                Aquí va una dirección <br>
                que sea real
            </p>
        </div>

        <div class="infoPie">
            <h3>Contacto</h3>
            <p>
                Y luego aquí va uno <br>
                o varios numeros de <br>
                contacto o correos
            </p>
        </div>

        <div class="infoPie">
            <h3>Redes Sociales</h3>
            <div class="redes">
                <div class="red1 imgRedes"></div>
                <div class="red2 imgRedes"></div>
                <div class="red3 imgRedes"></div>
                <div class="red4 imgRedes"></div>
            </div>            
        </div>
    </div>  
</body>
</html>
<?php

session_start();

require('PHP/Conexion.php');

$valorBoton = $_POST['boton'];
$cantidad = $_POST['cantidad'];

$accion = substr($valorBoton, 0, 1);
$tipoArtista = substr($valorBoton, 2, 1);
$numProducto = substr($valorBoton, 4, strlen($valorBoton)-4);

switch($tipoArtista){
    case '1': $tipoArtista = ""; break;
    case '2': $tipoArtista = "BoyGroup"; break;
    case '3': $tipoArtista = "GirlGroup"; break;
    case '4': $tipoArtista = "Solista Masculino"; break;
    case '5': $tipoArtista = "Solista Femenina"; break;
    case '6': $tipoArtista = "Duo"; break;
    case '7': $tipoArtista = "Grupo Mixto"; break;
}

if($tipoArtista != ""){
        $consultaSQL = "SELECT d.dis_id, d.dis_precioUnitario
                        FROM discos as d
                        JOIN artistas as a ON (a.art_id = d.art_id)
                        WHERE (a.art_tipo = '".$tipoArtista."')
                        ORDER BY d.dis_flanzamiento DESC
                        LIMIT ".$numProducto.", 1;";
} else{
    $consultaSQL = "SELECT d.dis_id, d.dis_precioUnitario
                    FROM discos as d
                    ORDER BY d.dis_flanzamiento DESC
                    LIMIT ".$numProducto.", 1;";
}

$ejecucion = mysqli_query($conexion, $consultaSQL);
$resultado = mysqli_fetch_assoc($ejecucion);

$disco_id = $resultado['dis_id'];
$disco_precio = $resultado['dis_precioUnitario']; 

if($accion == "1"){         
        
    $consultaSQL = "SELECT dis_existencia FROM discos WHERE dis_id = ".$disco_id.";";
    $ejecucion = mysqli_query($conexion, $consultaSQL);
    $resultado = mysqli_fetch_assoc($ejecucion);

    $existencia = $resultado['dis_existencia'];

    if($existencia < $cantidad){        
        echo '<script> alert("Por el momento no es posible cubrir la cantidad de producto solicitada"); window.location.href="catalogo.php" </script>';
    }    

} else{

    if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['usuario'])){
        $consultaSQL = "CALL agregarProductoCarrito('".$_SESSION['usuario']."', ".$disco_id.", ".$cantidad.");";
        mysqli_query($conexion, $consultaSQL);

        $consultaSQL = "CALL actualizarCarrito();";
        mysqli_query($conexion, $consultaSQL);  

        echo '<script language="javascript"> alert("Agregado exitosamente"); window.location.href="catalogo.php" </script>';
    } else{
        echo '<script language="javascript"> alert("Necesita ingresar una cuenta para agregar productos a su carrito"); window.location.href="catalogo.php" </script>';
    }
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

    <link rel="preload" href="CSS/estilos.css" as = "style">
    <link rel="stylesheet" href="CSS/estilos.css">

    <title>Venta</title>
</head>
<body>

    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <style>                        
        /* Media query for mobile viewport */
        @media screen and (max-width: 400px) {
            .paypal-button-container {
                width: 100%;
            }
        }
        
        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            .paypal-button-container {
                width: 250px;
                display: inline-block;
            }
        }        
    </style>

    <div class="contenedor sombra">
        <h2>Detalles de compra:</h2><br><br><br><br><br><br>

        <div class="detalles-compra">

            <div class="detalles-alineacion">
                <h3 style="text-align: left;"> Nombre del Producto: 
                    <?php
                        $consultaSQL = "SELECT dis_nombre FROM discos WHERE (dis_id = ".$disco_id.");";
                        $ejecucion = mysqli_query($conexion, $consultaSQL);
                        $resultado = mysqli_fetch_assoc($ejecucion);
                        echo $resultado['dis_nombre'];
                    ?>
                </h3> 

                <h3 style="text-align: left;"> Artista:
                    <?php
                        $consultaSQL = "SELECT art_nombre FROM artistas WHERE (art_id = (SELECT art_id FROM discos WHERE (dis_id = ".$disco_id.")));";
                        $ejecucion = mysqli_query($conexion, $consultaSQL);
                        $resultado = mysqli_fetch_assoc($ejecucion);
                        echo $resultado['art_nombre'];
                    ?>
                </h3>

                <h3 style="text-align: left;"> Fecha de lanzamiento:
                    <?php
                        $consultaSQL = "SELECT dis_flanzamiento FROM discos WHERE (dis_id = ".$disco_id.");";
                        $ejecucion = mysqli_query($conexion, $consultaSQL);
                        $resultado = mysqli_fetch_assoc($ejecucion);
                        echo $resultado['dis_flanzamiento'];
                    ?>
                </h3>

                <h3 style="text-align: left;"> Precio unitario: 
                    <?php
                        $consultaSQL = "SELECT dis_precioUnitario FROM discos WHERE (dis_id = ".$disco_id.");";
                        $ejecucion = mysqli_query($conexion, $consultaSQL);
                        $resultado = mysqli_fetch_assoc($ejecucion);
                        echo "$" . $resultado['dis_precioUnitario'] . " MXN";
                    ?>
                </h3> 

                <h3 style="text-align: left;"> Cantidad del producto: 
                    <?php
                        
                        echo $cantidad;              
                    ?>
                </h3>

                <hr width="100%">
                <h3 > Precio total:
                    <?php
                        $total = $cantidad * $disco_precio;
                        echo "$"  . $total . " MXN";              
                    ?>
                    
                </h3>                        

                <div id="paypal-button-container"> </div>
                
                <script>
                    paypal.Button.render({
                        env: 'sandbox', // sandbox | production
                        style: {
                            label: 'checkout',  // checkout | credit | pay | buynow | generic
                            size:  'responsive', // small | medium | large | responsive
                            shape: 'pill',   // pill | rect
                            color: 'silver'   // gold | blue | silver | black
                        },
                
                        // PayPal Client IDs - replace with your own
                        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                
                        client: {
                            sandbox:    'AcFC6Kxd73VrJLtqOJZnUSatcGMZcUbRyzBnFB2Km2gIqlmJVg2FhRhPV1sp4YznvIgMEfycWzMayQ2w',
                            production: '<insert production client id>'
                        },
                
                        // Wait for the PayPal button to be clicked
                
                        payment: function(data, actions) {
                            return actions.payment.create({
                                payment: {
                                    transactions: [
                                        {
                                            amount: { total: '<?php echo $total; ?>', currency: 'MXN' }, 
                                            // description:"",
                                            // custom:"Codigo"
                                        }
                                    ]
                                }
                            });
                        },
                
                        // Wait for the payment to be authorized by the customer
                
                        onAuthorize: function(data, actions) {
                            return actions.payment.execute().then(function() {
                                window.alert('¡Pago realizado!');
                                window.location = "catalogo.php";

                                <?php
                                
                                    if($existencia >= $cantidad){
                                        
                                        $consultaSQL = "CALL actualizarDiscoExistencia(".$disco_id.", ".$cantidad.");";
                                        mysqli_query($conexion, $consultaSQL);                                        
                                    }
                                    
                                
                                ?>                                
                            });
                        }
                    
                    }, '#paypal-button-container');
                
                </script>

            </div>

            <div class="detalles-alineacion">
                <?php
                    $consultaSQL = "SELECT art_nombre FROM artistas WHERE (art_id = (SELECT art_id FROM discos WHERE (dis_id = ".$disco_id.")));";
                    $ejecucion = mysqli_query($conexion, $consultaSQL);
                    $resultado = mysqli_fetch_assoc($ejecucion);
                    $artista_nombre = $resultado['art_nombre'];
                    
                    $consultaSQL = "SELECT dis_nombre FROM discos WHERE (dis_id = ".$disco_id.");";
                    $ejecucion = mysqli_query($conexion, $consultaSQL);
                    $resultado = mysqli_fetch_assoc($ejecucion);
                    $disco_nombre = $resultado['dis_nombre'];
                ?>
                <img class="detalles-imagen" src="Imagenes/Albums/<?php echo $artista_nombre . " - " . $disco_nombre; ?>.jpeg">
            </div>
        </div>

        
    </div>

</body>
</html>
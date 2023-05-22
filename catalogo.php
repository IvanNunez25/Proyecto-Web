<?php
session_start();
require('PHP/Conexion.php');
// $estatus = true;
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


    <link rel="preload" href="CSS/estilos.css" as="style">
    <link rel="stylesheet" href="CSS/estilos.css">

    <title>Catalogo</title>

</head>

<body>

    <div class="encabezado"> <!-- ------------------------------ -->
        <img src="Imagenes/shopping-bag.png">
        <header>
            <h1>Kpop Store</h1>
        </header>
    </div>

    <div class="navegacion"> <!-- ------------------------------ -->
        <nav class="barra-navegacion">
            <a href="index.php">Inicio</a>
            <a href="PHP/Cuenta.php">Mi Cuenta</a>
            <a href="catalogo.php">Catalogo</a>
            <a href="contacto.html">Contacto</a>
            <a href="sobrenosotros.html">Sobre Nosotros</a>
            <a href="PHP/CuentaAdmin.php">Administrador</a>
        </nav>
    </div>

    <!-- Productos Más Recientes -->
    <div class="contenedor sombra">

        <?php
        $sql = "SELECT * FROM productosmasrecientes LIMIT 4;";
        $ejecucion = mysqli_query($conexion, $sql);
        ?>

        <h2>Productos más recientes</h2>
        <div class="catalogo-masrecientes">

            <!-- PRODUCTO + RECIENTE N°1 -->
            <div class="catalogo-info">

                <?php
                $fila = mysqli_fetch_assoc($ejecucion);
                $nombre_artista = $fila['art_nombre'];
                $nombre_disco = $fila['dis_nombre'];
                $precio_disco = $fila['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-1-0" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-1-0" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO + RECIENTE N°2 -->
            <div class="catalogo-info">

                <?php
                $fila = mysqli_fetch_assoc($ejecucion);
                $nombre_artista = $fila['art_nombre'];
                $nombre_disco = $fila['dis_nombre'];
                $precio_disco = $fila['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-1-1" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-1-1" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO + RECIENTE N°3 -->
            <div class="catalogo-info">

                <?php
                $fila = mysqli_fetch_assoc($ejecucion);
                $nombre_artista = $fila['art_nombre'];
                $nombre_disco = $fila['dis_nombre'];
                $precio_disco = $fila['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-1-2" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-1-2" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO + RECIENTE N°4 -->
            <div class="catalogo-info">

                <?php
                $fila = mysqli_fetch_assoc($ejecucion);
                $nombre_artista = $fila['art_nombre'];
                $nombre_disco = $fila['dis_nombre'];
                $precio_disco = $fila['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-1-3" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-1-3" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Boy Groups -->
    <div class="contenedor sombra">

        <?php
        $sqlBG = "SELECT * FROM productosboygroups;";
        $ejecucionBG = mysqli_query($conexion, $sqlBG);
        ?>

        <h2>Boy Groups</h2>
        <div class="catalogo-masrecientes">

            <!-- PRODUCTO BOYGROUP N°1 -->
            <div class="catalogo-info">

                <?php
                $filaBG = mysqli_fetch_assoc($ejecucionBG);
                $nombre_artista = $filaBG['art_nombre'];
                $nombre_disco = $filaBG['dis_nombre'];
                $precio_disco = $filaBG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-2-0" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-2-0" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO BOYGROUP N°2 -->
            <div class="catalogo-info">

                <?php
                $filaBG = mysqli_fetch_assoc($ejecucionBG);
                $nombre_artista = $filaBG['art_nombre'];
                $nombre_disco = $filaBG['dis_nombre'];
                $precio_disco = $filaBG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-2-1" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-2-1" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO BOYGROUP N°3 -->
            <div class="catalogo-info">

                <?php
                $filaBG = mysqli_fetch_assoc($ejecucionBG);
                $nombre_artista = $filaBG['art_nombre'];
                $nombre_disco = $filaBG['dis_nombre'];
                $precio_disco = $filaBG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-2-2" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-2-2" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO BOYGROUP N°4 -->
            <div class="catalogo-info">

                <?php
                $filaBG = mysqli_fetch_assoc($ejecucionBG);
                $nombre_artista = $filaBG['art_nombre'];
                $nombre_disco = $filaBG['dis_nombre'];
                $precio_disco = $filaBG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-2-3" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-2-3" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- GirlGroups -->
    <div class="contenedor sombra">

        <?php
        $sqlGG = "SELECT * FROM productosgirlgroups;";
        $ejecucionGG = mysqli_query($conexion, $sqlGG);
        ?>

        <h2>Girl Groups</h2>
        <div class="catalogo-masrecientes">

            <!-- PRODUCTO GIRLGROUP N°1 -->
            <div class="catalogo-info">

                <?php
                $filaGG = mysqli_fetch_assoc($ejecucionGG);
                $nombre_artista = $filaGG['art_nombre'];
                $nombre_disco = $filaGG['dis_nombre'];
                $precio_disco = $filaGG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-3-0" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-3-0" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO GIRLGROUP N°2 -->
            <div class="catalogo-info">

                <?php
                $filaGG = mysqli_fetch_assoc($ejecucionGG);
                $nombre_artista = $filaGG['art_nombre'];
                $nombre_disco = $filaGG['dis_nombre'];
                $precio_disco = $filaGG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-3-1" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-3-1" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO GIRLGROUP N°3 -->
            <div class="catalogo-info">

                <?php
                $filaGG = mysqli_fetch_assoc($ejecucionGG);
                $nombre_artista = $filaGG['art_nombre'];
                $nombre_disco = $filaGG['dis_nombre'];
                $precio_disco = $filaGG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-3-2" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-3-2" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO GIRLGROUP N°4 -->
            <div class="catalogo-info">

                <?php
                $filaGG = mysqli_fetch_assoc($ejecucionGG);
                $nombre_artista = $filaGG['art_nombre'];
                $nombre_disco = $filaGG['dis_nombre'];
                $precio_disco = $filaGG['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-3-3" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-3-3" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Solistas Masculinos -->
    <div class="contenedor sombra">

        <?php
        $sqlSM = "SELECT * FROM productossolistasmasculinos;";
        $ejecucionSM = mysqli_query($conexion, $sqlSM);
        ?>

        <h2>Solistas</h2>
        <div class="catalogo-masrecientes">

            <!-- PRODUCTO SOLISTAS M N°1 -->
            <div class="catalogo-info">

                <?php
                $filaSM = mysqli_fetch_assoc($ejecucionSM);
                $nombre_artista = $filaSM['art_nombre'];
                $nombre_disco = $filaSM['dis_nombre'];
                $precio_disco = $filaSM['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-4-0" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-4-0" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO SOLISTAS M N°2 -->
            <div class="catalogo-info">

                <?php
                $filaSM = mysqli_fetch_assoc($ejecucionSM);
                $nombre_artista = $filaSM['art_nombre'];
                $nombre_disco = $filaSM['dis_nombre'];
                $precio_disco = $filaSM['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-4-1" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-4-1" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO SOLISTAS M N°3 -->
            <div class="catalogo-info">

                <?php
                $filaSM = mysqli_fetch_assoc($ejecucionSM);
                $nombre_artista = $filaSM['art_nombre'];
                $nombre_disco = $filaSM['dis_nombre'];
                $precio_disco = $filaSM['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-4-2" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-4-2" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO SOLISTAS M N°4 -->
            <div class="catalogo-info">

                <?php
                $filaSM = mysqli_fetch_assoc($ejecucionSM);
                $nombre_artista = $filaSM['art_nombre'];
                $nombre_disco = $filaSM['dis_nombre'];
                $precio_disco = $filaSM['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-4-3" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-4-3" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Solistas Femeninas -->
    <div class="contenedor sombra">

        <?php
        $sqlSF = "SELECT * FROM productossolistasfemeninas;";
        $ejecucionSF = mysqli_query($conexion, $sqlSF);
        ?>

        <h2>Solistas</h2>
        <div class="catalogo-masrecientes">

            <!-- PRODUCTO SOLISTAS F N°1 -->
            <div class="catalogo-info">

                <?php
                $filaSF = mysqli_fetch_assoc($ejecucionSF);
                $nombre_artista = $filaSF['art_nombre'];
                $nombre_disco = $filaSF['dis_nombre'];
                $precio_disco = $filaSF['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-5-0" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-5-0" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO SOLISTAS F N°2 -->
            <div class="catalogo-info">

                <?php
                $filaSF = mysqli_fetch_assoc($ejecucionSF);
                $nombre_artista = $filaSF['art_nombre'];
                $nombre_disco = $filaSF['dis_nombre'];
                $precio_disco = $filaSF['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-5-1" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-5-1" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO SOLISTAS F N°3 -->
            <div class="catalogo-info">

                <?php
                $filaSF = mysqli_fetch_assoc($ejecucionSF);
                $nombre_artista = $filaSF['art_nombre'];
                $nombre_disco = $filaSF['dis_nombre'];
                $precio_disco = $filaSF['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-5-2" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-5-2" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO SOLISTAS F N°4 -->
            <div class="catalogo-info">

                <?php
                $filaSF = mysqli_fetch_assoc($ejecucionSF);
                $nombre_artista = $filaSF['art_nombre'];
                $nombre_disco = $filaSF['dis_nombre'];
                $precio_disco = $filaSF['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-5-3" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-5-3" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- DUOS -->
    <div class="contenedor sombra">

        <?php
        $sqlD = "SELECT * FROM productosduos;";
        $ejecucionD = mysqli_query($conexion, $sqlD);
        ?>

        <h2>Duos</h2>
        <div class="catalogo-masrecientes">

            <!-- PRODUCTO DUOS N°1 -->
            <div class="catalogo-info">

                <?php
                $filaD = mysqli_fetch_assoc($ejecucionD);
                $nombre_artista = $filaD['art_nombre'];
                $nombre_disco = $filaD['dis_nombre'];
                $precio_disco = $filaD['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-6-0" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-6-0" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO DUOS N°2 -->
            <div class="catalogo-info">

                <?php
                $filaD = mysqli_fetch_assoc($ejecucionD);
                $nombre_artista = $filaD['art_nombre'];
                $nombre_disco = $filaD['dis_nombre'];
                $precio_disco = $filaD['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-6-1" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-6-1" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO DUOS N°3 -->
            <div class="catalogo-info">

                <?php
                $filaD = mysqli_fetch_assoc($ejecucionD);
                $nombre_artista = $filaD['art_nombre'];
                $nombre_disco = $filaD['dis_nombre'];
                $precio_disco = $filaD['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-6-2" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-6-2" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>

            <!-- PRODUCTO DUOS N°4 -->
            <div class="catalogo-info">

                <?php
                $filaD = mysqli_fetch_assoc($ejecucionD);
                $nombre_artista = $filaD['art_nombre'];
                $nombre_disco = $filaD['dis_nombre'];
                $precio_disco = $filaD['dis_precioUnitario'];
                ?>

                <img class="catalogo-imgGral" src="Imagenes/Albums/<?php echo $nombre_artista . " - " . $nombre_disco; ?>.jpeg">

                <div class="catalogo-info-alineacion">
                    <h2><?php echo $nombre_disco; ?></h2>
                    <h3><?php echo $nombre_artista; ?></h3>
                    <h2><br><?php echo '$' . $precio_disco; ?></h2>
                </div>

                <form method="POST" action="parametrosventa.php">
                    <div class="botones-compra">

                        <button name="boton" value="1-6-3" title="Comprar" class="boton-agregarCarrito">
                            <img src="Imagenes/compra-en-linea.png" class="imagenCarrito">
                        </button>

                        <button name="boton" value="2-6-3" title="Agregar al carrito" class="boton-agregarCarrito">
                            <img src="Imagenes/anadir-al-carrito.png" class="imagenCarrito">
                        </button>
                    </div>

                    <div class="botones-compra">
                        <label>Cantidad:</label>
                        <input type='number' min='1' max='50' step='1' value='1' size='6' name='cantidad'>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="pie-pagina"> <!-- ------------------------------ -->

        <div class="infoPie">
            <h3 style="font-size: 30px;">Ubicación</h3>
            <p style="font-size: 22px;">
                Blvd. Revolución y Av. Instituto Tecnológico de La Laguna, Torreón, Coahuila, C.P. 27000
            </p>
        </div>

        <div class="infoPie">
            <h3 style="font-size: 30px;">Contacto</h3>
            <p style="font-size: 22px;">
                Desarrolladores: <br><br>
                ivan25606@gmail.com <br>
                marianjuache1@gmail.com
            </p>
        </div>

        <div class="infoPie">
            <h3 style="font-size: 30px;">Redes Sociales</h3>
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
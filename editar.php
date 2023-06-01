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

    <title>Editar</title>

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

    <?php
    require('PHP/Conexion.php');

    $ID = $_GET['id'];

    $sql = "SELECT * FROM discos WHERE dis_id = '" . $ID . "';";
    $ejecucion = mysqli_query($conexion, $sql);

    $registro = mysqli_fetch_assoc($ejecucion);

    $nombre = $registro['dis_nombre'];
    $flanzamiento = $registro['dis_flanzamiento'];
    $precio = $registro['dis_precioUnitario'];
    $stock = $registro['dis_existencia'];

    ?>

    <div class="editar-form">
        <form name="formularioInsertarDiscos" onsubmit="return ValidarDisco()" action="PHP/EditarProducto.php?id=<?php echo $ID?>" method="POST">

            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">

            <label>Fecha de lanzamiento:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $flanzamiento; ?>">

            <label>Precio:</label>
            <input type="number" name="precio" id="precio" value="<?php echo $precio; ?>">

            <label>Existencia:</label>
            <input type="number" name="existencia" id="existencia" value="<?php echo $stock; ?>">

            <button>Guardar</button>

        </form>
    </div>

</body>

</html>
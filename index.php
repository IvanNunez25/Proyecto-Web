<?php
require('PHP/Conexion.php');
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

    <!-- <link rel="stylesheet" href="CSS/slider.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="JavaScript/carrusel.js" defer></script>

    <title>K-STORE!</title>
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

    <div class="imagenPrincipal"> <!-- ------------------------------ -->
        <div class="informacion">
            <h2>¡ B I E N V E N I D O !</h2>
        </div>
    </div>

    <div class="contenedor sombra"> <!-- ------------------------------ -->

        <h2>Productos más recientes:</h2>

        <?php
        $sql = "SELECT * FROM productosmasrecientes LIMIT 11;";
        $ejecucion = mysqli_query($conexion, $sql);
        ?>

        <div class="wrapper">
            <i id="left" class='bx bx-chevron-left'></i>
            <div class="carrusel">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
                <img <?php $fila = mysqli_fetch_assoc($ejecucion); ?> src="Imagenes/Albums/<?php echo $fila['art_nombre'] . ' - ' . $fila['dis_nombre'] ?>.jpeg" alt="" draggable="false">
            </div>
            <i id="right" class='bx bx-chevron-right'></i>
        </div>

    </div>

    <div class="estadisticas"> <!-- ------------------------------ -->
        <h2>Estadisticas</h2>
        <div class="numeros">
            <div class="sombra">
                <h2>+500<br>Artistas</h2>
            </div>
            <div class="sombra">
                <h2>+2500<br>Productos</h2>
            </div>
            <div class="sombra">
                <h2>+300<br>Usuarios</h2>
            </div>
            <div class="sombra">
                <h2>+6000<br>Ventas</h2>
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
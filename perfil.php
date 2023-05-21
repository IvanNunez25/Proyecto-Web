<?php
session_start();

require('PHP/Conexion.php');

if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['usuario'])) {
} else {
    header("Location: miCuenta.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/nuevadatatable.css">

    <link rel="preload" href="CSS/normalize.css" as="style">
    <link rel="style" href="CSS/normalize.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;1,200&display=swap" rel="stylesheet">

    <!-- <link rel="preload" href="CSS/miCuenta.css" as = "style">
    <link rel="stylesheet" href="CSS/miCuenta.css"> -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="CSS/datatable.css">


    <link rel="preload" href="CSS/estilos.css" as="style">
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
            <div class="container my-4 contenedor-de-tabla">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <table class="table" id="datatable_usuarios">
                            <thead>
                                <tr>
                                    <th class="centrado">#</th>
                                    <th class="centrado">Artista</th>
                                    <th class="centrado">Producto</th>
                                    <th class="centrado">Cantidad</th>
                                    <th class="centrado">Precio</th>
                                    <th class="centrado">Total</th>
                                    <th class="centrado">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody_usuarios"></tbody>
                        </table>
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



    <script src="JavaScript/tablaCarrito.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- Sweet Alert 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.js"></script>

</body>

</html>
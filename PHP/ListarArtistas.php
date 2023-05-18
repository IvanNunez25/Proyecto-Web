<?php

require('Conexion.php');

$consulta = mysqli_query($conexion, "SELECT art_nombre, art_tipo FROM artistas ORDER BY art_nombre ASC;");
$artistas = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

if (!empty($artistas)) {
    echo json_encode($artistas);
} else {
    echo json_encode([]);
}

<?php

require('Conexion.php');

$consulta = mysqli_query($conexion, "SELECT d.dis_nombre, d.dis_flanzamiento, d.dis_precioUnitario, d.dis_existencia, a.art_nombre 
                                      FROM discos AS d
                                      JOIN artistas AS a ON (a.art_id = d.art_id)");

$resultado = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

if(!empty($resultado)){
    echo json_encode($resultado);
} else {
    echo json_encode([]);
}

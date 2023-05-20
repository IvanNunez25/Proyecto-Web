<?php

require('Conexion.php');

$consulta = mysqli_query($conexion, "SELECT a.art_id, a.art_nombre, a.art_tipo, COUNT(d.dis_id) AS art_productos 
                                      FROM artistas AS a
                                      LEFT JOIN discos AS d ON (a.art_id = d.art_id)
                                      GROUP BY a.art_nombre
                                      ORDER BY a.art_nombre");

$resultado = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

if(!empty($resultado)){
    echo json_encode($resultado);
} else {
    echo json_encode([]);
}

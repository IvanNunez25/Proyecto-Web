<?php

require('Conexion.php');

$consulta = mysqli_query($conexion, "SELECT a.art_nombre, d.dis_nombre, SUM(dt.det_cantidad) AS cantidad
                                    FROM artistas AS a
                                    JOIN discos AS d ON (a.art_id = d.art_id)
                                    JOIN detalles AS dt ON (d.dis_id = dt.dis_id)
                                    GROUP BY d.dis_nombre
                                    ORDER BY SUM(dt.det_cantidad) DESC
                                    LIMIT 10;");

$resultado = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

if (!empty($resultado)) {
    echo json_encode($resultado);
} else {
    echo json_encode([]);
}

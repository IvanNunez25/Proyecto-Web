<?php

session_start();
require('Conexion.php');

$consulta = mysqli_query($conexion, "SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario, cd.cardis_cantidad, cd.cardis_id, cd.dis_id, d.dis_precioUnitario, d.dis_existencia, d.dis_id
                                     FROM artistas as a
                                     JOIN discos as d ON (a.art_id = d.art_id)
                                     JOIN carritos_discos as cd ON (d.dis_id = cd.dis_id)
                                     JOIN carritos as c ON (cd.car_id = c.car_id)
                                     JOIN clientes as cl ON (c.cte_id = cl.cte_id)
                                     WHERE cl.cte_nombre = '".$_SESSION['usuario']."';");

$resultado = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

if (!empty($resultado)) {
    echo json_encode($resultado);
} else {
    echo json_encode([]);
}

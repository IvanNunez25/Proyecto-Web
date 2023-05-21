<?php

session_start();
require('Conexion.php');

$consulta = mysqli_query($conexion, "SELECT v.vta_id 
                                    FROM ventas AS v 
                                    JOIN clientes AS c ON (c.cte_id = v.cte_id)
                                    WHERE cte_nombre = '".$_SESSION['usuario']."'
                                    ORDER BY v.vta_fecha DESC
                                    LIMIT 1;");

$resultado = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

if(!empty($resultado)){
    echo json_encode($resultado);
} else {
    echo json_encode([]);
}

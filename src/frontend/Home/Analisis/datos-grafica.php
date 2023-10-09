<?php
    include_once '../../../backend/conexion.php';
    $year = date('Y');
    $meses = [];
    for($i=1; $i<=12; $i++){
        $ultimo_dia = date('t', strtotime("$year-$i-01"));
        $fecha_inicio = "$year-$i-01";
        $fecha_fin = "$year-$i-$ultimo_dia";
        $total = 0;
        $sql = "SELECT * FROM ventas WHERE fecha >= '$fecha_inicio' AND fecha <= '$fecha_fin'";
        $resultado = mysqli_query($conexion, $sql);
        if($resultado->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $total += $fila['total'];
                $meses[$i] = $total;
            }
        }else{
            $meses[$i] = 0;
        }
    }
    echo json_encode($meses);
?>
<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "ferreteria";
    $conexion = mysqli_connect($host, $user, $password, $db);

    if(!$conexion){
        echo "Error en la conexión";
    }
?>
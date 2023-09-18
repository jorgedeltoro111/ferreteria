<?php
include_once "../conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado datos de nombre y correo
    if (isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["precio"]) && isset($_POST["existencias"])) {
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $existencias = $_POST["existencias"];
        
        $sql = "INSERT INTO productos (nombre, descripcion, precio, existencias)
            VALUES ('$nombre', '$descripcion' , '$precio', '$existencias')";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Productos/productos.php");
        } else {
            echo "Error al insertar el registro: " . $conexion->error;
        }
    } else {
        // Manejo de errores si no se proporcionan los campos requeridos
        echo "Por favor, complete todos los campos requeridos.";
    }
}
?>

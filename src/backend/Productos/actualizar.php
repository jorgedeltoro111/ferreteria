<?php
include_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado datos válidos
    if (isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["precio"]) && isset($_POST["existencias"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $existencias = $_POST["existencias"];
        
        // Consulta SQL para actualizar el registro
        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', existencias='$existencias' WHERE id='$id'";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Productos/productos.php");
        } else {
            echo "Error al actualizar el registro: " . $conexion->error;
        }
    } else {
        // Manejo de errores si no se proporcionan los campos requeridos
        echo "Por favor, complete todos los campos requeridos.";
    }
}
?>

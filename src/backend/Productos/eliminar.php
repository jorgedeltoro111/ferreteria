<?php
include_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el producto a eliminar
    if (isset($_POST["productosEliminar"]) && is_numeric($_POST["productosEliminar"])) {
        $productosId = $_POST["productosEliminar"];
        
        // Consulta SQL para eliminar el producto
        $sql = "UPDATE productos SET activo = 0 WHERE id = $productosId";
        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Productos/productos.php");
        } else {
            echo "Error al eliminar al proveedore: " . $conexion->error;
        }
    } 
}
?>

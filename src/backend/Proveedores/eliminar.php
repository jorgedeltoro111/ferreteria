<?php
include_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el cliente a eliminar
    if (isset($_POST["proveedoresEliminar"]) && is_numeric($_POST["proveedoresEliminar"])) {
        $proveedoresId = $_POST["proveedoresEliminar"];
        
        // Consulta SQL para eliminar el cliente
        $sql = "UPDATE proveedores SET activo = 0 WHERE id = $proveedoresId";
        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Proveedores/proveedores.php");
        } else {
            echo "Error al eliminar al proveedore: " . $conexion->error;
        }
    } 
}
?>

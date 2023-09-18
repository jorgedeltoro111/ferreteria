<?php
include_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el cliente a eliminar
    if (isset($_POST["usuariosEliminar"]) && is_numeric($_POST["usuariosEliminar"])) {
        $usuarioId = $_POST["usuariosEliminar"];
        
        // Consulta SQL para eliminar el cliente
        $sql = "DELETE FROM usuarios WHERE id = $usuarioId";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Usuarios/usuarios.php");
        } else {
            echo "Error al eliminar al proveedore: " . $conexion->error;
        }
    } 
}
?>

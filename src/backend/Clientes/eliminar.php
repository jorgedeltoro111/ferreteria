<?php
include_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el cliente a eliminar
    if (isset($_POST["clienteEliminar"]) && is_numeric($_POST["clienteEliminar"])) {
        $clienteId = $_POST["clienteEliminar"];
        
        // Consulta SQL para eliminar el cliente
        $sql = "DELETE FROM clientes WHERE id = $clienteId";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Clientes/clientes.php");
        } else {
            echo "Error al eliminar el cliente: " . $conexion->error;
        }
    } 
}
?>

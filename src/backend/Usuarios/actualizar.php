<?php
include_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado datos válidos
    if (isset($_POST["id"]) && isset($_POST["usuario"]) && isset($_POST["password"])) {
        $id = $_POST["id"];
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        
        // Consulta SQL para actualizar el registro
        $sql = "UPDATE usuarios SET usuario='$usuario', password='$password' WHERE id='$id'";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Usuarios/usuarios.php");
        } else {
            echo "Error al actualizar el registro: " . $conexion->error;
        }
    } else {
        // Manejo de errores si no se proporcionan los campos requeridos
        echo "Por favor, complete todos los campos requeridos.";
    }
}
?>

<?php
include_once "../conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado datos de nombre y correo
    if (isset($_POST["usuario"]) && isset($_POST["password"]) && isset($_POST["activo"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $activo = $_POST["activo"];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO usuarios (usuario, password, activo)
            VALUES ('$usuario', '$hashed_password', '$activo')";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Usuarios/usuarios.php");
        } else {
            echo "Error al insertar el registro: " . $conexion->error;
        }
    } else {
        // Manejo de errores si no se proporcionan los campos requeridos
        echo "Por favor, complete todos los campos requeridos.";
    }
}
?>

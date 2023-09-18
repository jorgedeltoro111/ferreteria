<?php
include_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado datos válidos
    if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["adress"]) && isset($_POST["phone"]) && isset($_POST["email"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $adress = $_POST["adress"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        
        // Consulta SQL para actualizar el registro
        $sql = "UPDATE proveedores SET name='$name', adress='$adress', phone='$phone', email='$email' WHERE id='$id'";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Proveedores/proveedores.php");
        } else {
            echo "Error al actualizar el registro: " . $conexion->error;
        }
    } else {
        // Manejo de errores si no se proporcionan los campos requeridos
        echo "Por favor, complete todos los campos requeridos.";
    }
}
?>

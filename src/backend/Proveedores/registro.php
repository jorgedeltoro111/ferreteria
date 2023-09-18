<?php
include_once "../conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado datos de nombre y correo
    if (isset($_POST["name"]) && isset($_POST["adress"]) && isset($_POST["phone"]) && isset($_POST["email"])) {
        $name = $_POST["name"];
        $adress = $_POST["adress"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        
        $sql = "INSERT INTO proveedores (name, adress, phone, email)
            VALUES ('$name', '$adress', '$phone', '$email')";

        if ($conexion->query($sql) === TRUE) {
            header("Location: ../../frontend/Home/Proveedores/proveedores.php");
        } else {
            echo "Error al insertar el registro: " . $conexion->error;
        }
    } else {
        // Manejo de errores si no se proporcionan los campos requeridos
        echo "Por favor, complete todos los campos requeridos.";
    }
}
?>

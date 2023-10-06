<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../fronted/Index/index.php"); // Redirige a la página de inicio de sesión
    exit();
}

include_once '../../../backend/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $total = 0;
    $idUsuario = $_SESSION['id'];

    // Inserta la venta
    $sqlVenta = "INSERT INTO ventas (total, id_usuario) VALUES ($total, $idUsuario)";
    if ($conexion->query($sqlVenta) === TRUE) {
        $idVenta = $conexion->insert_id;

        // Itera sobre los productos
        foreach ($data as $producto) {
            $idProducto = $producto['id'];
            $cantidad = $producto['cantidad'];
            $porcentaje = $producto['porcentaje'];

            // Obtiene el precio del producto
            $sqlPrecio = "SELECT precio FROM productos WHERE id = $idProducto";
            $resultadoPrecio = $conexion->query($sqlPrecio);
            if ($resultadoPrecio->num_rows > 0) {
                $rowPrecio = $resultadoPrecio->fetch_assoc();
                $precioProducto = $rowPrecio['precio'];

                // Calcula el subtotal y actualiza el total de la venta
                $utilidad = $precioProducto * $porcentaje;
                $precioProducto = $precioProducto + ($precioProducto * $porcentaje);
                $subtotal = $precioProducto * $cantidad;
                $total += $subtotal;
                
                // Actualiza las existencias
                $sqlExistencias = "SELECT existencias FROM productos WHERE id = $idProducto";
                $resultadoExistencias = $conexion->query($sqlExistencias);
                if ($resultadoExistencias->num_rows > 0) {
                    $rowExistencias = $resultadoExistencias->fetch_assoc();
                    $existencias = $rowExistencias['existencias'] - $cantidad;

                    // Actualiza las existencias en la base de datos
                    $sqlActualizarExistencias = "UPDATE productos SET existencias = $existencias WHERE id = $idProducto";
                    $conexion->query($sqlActualizarExistencias);

                    // Registra el detalle de la venta
                    $sqlDetalleVenta = "INSERT INTO detalleventas (piezas, id_venta, id_producto, utilidad) VALUES ($cantidad, $idVenta, $idProducto, $utilidad)";
                    $conexion->query($sqlDetalleVenta);
                }
            }
        }

        // Actualiza el total de la venta
        $sqlActualizarTotal = "UPDATE ventas SET total = $total WHERE id = $idVenta";
        $conexion->query($sqlActualizarTotal);

        echo json_encode(array('id_venta' => $idVenta));
    } else {
        http_response_code(500); // Error interno del servidor
        echo json_encode(array('error' => 'Error al guardar la venta: ' . $conexion->error));
    }
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>

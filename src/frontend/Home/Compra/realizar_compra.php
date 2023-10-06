<?php
session_start();
include_once '../../../backend/conexion.php';
// Recibir los datos enviados por JavaScript
$data = json_decode(file_get_contents("php://input"));
// Acceder a los datos
$total = $data->total;
$productos = $data->productos;
$proveedor = $data->proveedor;
$idUsuario = $_SESSION['id'];
//creacion de comanda
$sql = "INSERT INTO compras (total, id_usuario, id_proveedor) VALUES ($total, $idUsuario, $proveedor)";
if($conexion->query($sql)){
    $idCompra = $conexion->insert_id;

    // Iterar sobre los productos y registrarlos
    foreach ($productos as $producto) {
        $nombre = $conexion->real_escape_string($producto->nombre);
        $descripcion = $conexion->real_escape_string($producto->descripcion);
        $precio = $producto->precio;
        $existencias = $producto->existencias;

        // Verificar si el producto ya existe
        $sqlBuscar = "SELECT * FROM productos WHERE nombre = '$nombre'";
        $result = $conexion->query($sqlBuscar);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idProducto = $row['id'];

            // Actualizar existencias y registrar el detalle de la compra
            $sqlExistencias = "UPDATE productos SET existencias = existencias + $existencias, precio = $precio WHERE id = $idProducto";
            $conexion->query($sqlExistencias);

            $sqlDetalleCompra = "INSERT INTO detallecompras (piezas, id_producto, id_compra) VALUES ($existencias, $idProducto, $idCompra)";
            $conexion->query($sqlDetalleCompra);
        } else {
            // Crear el producto y registrar el detalle de la compra
            $sqlProducto = "INSERT INTO productos (nombre, descripcion, precio, existencias, id_proveedor) 
                            VALUES ('$nombre', '$descripcion', $precio, $existencias, $proveedor)";
            $conexion->query($sqlProducto);

            $idProducto = $conexion->insert_id;

            $sqlDetalleCompra = "INSERT INTO detallecompras (piezas, id_producto, id_compra) 
                                VALUES ($existencias, $idProducto, $idCompra)";
            $conexion->query($sqlDetalleCompra);
        }
    }

    // Responder con un mensaje (puede ser un objeto JSON)
    $response = array('message' => 'Compra realizada exitosamente');
    echo json_encode($response);
}else{
    echo json_encode(array('message' => 'Error al realizar la compra'));
    exit();
}





// Responder con un mensaje (puede ser un objeto JSON)
$response = array('message' => 'Compra realizada exitosamente');
echo json_encode($response);
?>

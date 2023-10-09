<?php
// ... Tu código para establecer la conexión y otras operaciones necesarias ...
include '../../../backend/conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mes'])) {
        $mes = $_POST['mes'];
    } else {
        $mes = date('m');
    }
} else {
    $mes = date('m');
}

// Realiza tu consulta SQL y genera la tabla en formato HTML
$sql_productos_ranking = "SELECT
    productos.nombre AS Producto,
    SUM(detalleventas.piezas) AS TotalPiezasVendidas
    FROM
    detalleventas
    INNER JOIN
    productos ON detalleventas.id_producto = productos.id
    INNER JOIN
    ventas ON detalleventas.id_venta = ventas.id
    WHERE
    MONTH(ventas.fecha) = $mes
    GROUP BY
    detalleventas.id_producto, productos.nombre
    ORDER BY
    TotalPiezasVendidas DESC;";

$resultado_productos_ranking = mysqli_query($conexion, $sql_productos_ranking);

// Genera la tabla en formato HTML
$tablaHTML = "<table class='table table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>Producto</th>
                        <th scope='col'>Veces vendido</th>
                    </tr>
                </thead>
                <tbody>";

while ($fila_productos_ranking = mysqli_fetch_assoc($resultado_productos_ranking)) {
    $tablaHTML .= "<tr>";
    $tablaHTML .= "<td>" . $fila_productos_ranking['Producto'] . "</td>";
    $tablaHTML .= "<td>" . $fila_productos_ranking['TotalPiezasVendidas'] . "</td>";
    $tablaHTML .= "</tr>";
}

$tablaHTML .= "</tbody></table>";

echo $tablaHTML;
?>

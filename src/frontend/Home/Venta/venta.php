<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../Index/index.php"); // Redirige a la página de inicio de sesión
    exit();
}
// Conexión a la base de datos
include_once '../../../backend/conexion.php';

// Consulta SQL para obtener los clientes
$sql = "SELECT * FROM ventas";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./venta.js"></script>
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Ventas</h1>
            <a href="../home.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
    <ul class="nav nav-tabs m-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#nuevaVenta" role="tab" aria-controls="ventas" aria-expanded="true">Nueva venta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#ventas" role="tab" aria-controls="nuevaVenta" aria-expanded="false">Ventas</a>
        </li>
    </ul>
    <div class="tab-content m-3" id="myTabContent">
        <div class="tab-pane fade show active" id="nuevaVenta" role="tabpanel" aria-labelledby="home-tab">
            <form>
                <div class="row">
                    <h6 class="bg-warning text-black rounded p-2">Presiona F5 para limpiar la venta</h6>
                    <div class="col">
                        <label for="idProducto" class="form-label">Producto</label>
                        <select class="form-select" id="idProducto">
                            <option value="0" selected>Selecciona un producto</option>
                            <?php
                            // Consulta SQL para obtener los productos
                            $sql = "SELECT * FROM productos";
                            $result = $conexion->query($sql);
                            if ($result->num_rows > 0) {
                                // Itera sobre los productos
                                while($row = $result->fetch_assoc()) {
                                    if($row['existencias'] > 0){
                                        echo "<option value='" . $row['id'] . "' data-existencias='" . $row['existencias'] . "'>" . $row['nombre'] . " - $" . $row['precio'] ."</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" min="1" value="1">
                    </div>
                    <div class="col">
                        <label for="agregar" class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-success form-control" id="agregar">Agregar</button>
                    </div>
                </div>
                <div class="col">
                    <label for="guardarVenta" class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-primary form-control" id="guardarVenta" onclick="confirmacion();">Realizar Venta</button>
                    <script>
                        function confirmacion(){
                            alert("Venta realizada con éxito");
                        }
                    </script>
                </div>
            </form>
            <div id="existenciasAlert"></div>
            <ul id="listaProductos" class="list-group"></ul>
        </div>
        <div class="tab-pane fade" id="ventas" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Folio</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta SQL para obtener las ventas
                    $sql = "SELECT * FROM ventas ORDER BY fecha DESC";
                    $result = $conexion->query($sql);
                    if ($result->num_rows > 0) {
                        // Itera sobre las ventas
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['total'] . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "<td><a href='ver_venta.php?id=".$row['id']."&total=" .$row['total'] . "' class='btn btn-primary'>Ver</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
    </div>
</body>
</html>

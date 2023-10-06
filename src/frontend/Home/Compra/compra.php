<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../Index/index.php"); // Redirige a la página de inicio de sesión
    exit();
}
// Conexión a la base de datos
include_once '../../../backend/conexion.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type="text/javascript" src="compra.js"></script>
    <link rel="stylesheet" href="compra.css">
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Compras</h1>
            <a href="../home.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
    <ul class="nav nav-tabs m-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#nuevaCompra" role="tab" aria-controls="compras" aria-expanded="true">Nueva compra</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#compras" role="tab" aria-controls="nuevaCompra" aria-expanded="false">Compras</a>
        </li>
    </ul>
    <div class="tab-content m-3" id="myTabContent"></div>
        <div class="tab-pane fade show active" id="nuevaCompra" role="tabpanel" aria-labelledby="home-tab">
            <div class="container">
    <h6 class="bg-warning text-black rounded p-2">Presiona F5 para reiniciar la compra</h6>
    <h4>Realizar Compra</h4>
    <!-- Formulario para ingresar información de la compra -->
        <form>
        <select name="proveedores" id="proveedores" onchange="obtenerProveedorSeleccionado(this.value)">
            <?php
                // Consulta SQL para obtener los clientes
                $sql = "SELECT id, name FROM proveedores";
                $result = $conexion->query($sql);
                echo "<option value='0'>Selecciona un proveedor</option>";
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                }
            ?>
        </select>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" placeholder="Descripción del producto">
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" placeholder="$500">
            </div>
            <div class="form-group">
                <label for="existencias">Existencias:</label>
                <input type="text" class="form-control" id="existencias" placeholder="5">
            </div>

            <button type="button" class="btn btn-primary mt-3" onclick="agregarNuevoProducto()">Agregar Nuevo Producto</button>
            <button type="submit" class="btn btn-success float-left mt-3" onclick="realizarCompra()">Realizar Compra</button>
            <h6 id="total" class="mt-3">Total: $0.00</h6>
            <!-- Lista de productos seleccionados -->
            <ul id="listaProductos" class="list-group mt-3">
                <!-- La lista de productos seleccionados se mostrará aquí -->
            </ul>
        </form>
    </div>
        <div class="tab-pane fade" id="compras" role="tabpanel" aria-labelledby="profile-tab">
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

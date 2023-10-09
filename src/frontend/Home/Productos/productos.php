<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../frontend/Index/index.php"); // Redirige a la página de inicio de sesión
    exit();
}
// Conexión a la base de datos
include_once '../../../backend/conexion.php';

// Consulta SQL para obtener los clientes
$sql = "SELECT * FROM productos";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../../../img/icon.png">
    <link type="text/css" rel="stylesheet" href="./productos.css">
    <script type="text/javascript" src="./productos.js"></script>
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Productos</h1>
            <a href="../home.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
    <ul class="nav nav-tabs m-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#productos" role="tab" aria-controls="productos" aria-expanded="true">Productos</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#registrar" role="tab" aria-controls="registrar" aria-expanded="false">Registrar</a>
        </li>-->
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#modificar" role="tab" aria-controls="modificar" aria-expanded="false">Modificar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#eliminar" role="tab" aria-controls="eliminar" aria-expanded="false">Eliminar</a>
        </li>
    </ul>
    <div class="tab-content m-3" id="myTabContent">
        <div class="tab-pane fade show active" id="productos" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-light">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Existencias</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<th scope='row'>".$row['id']."</th>";
                            echo "<td>".$row['nombre']."</td>";
                            echo "<td>".$row['descripcion']."</td>";
                            echo "<td>".$row['precio']."</td>";
                            echo "<td>".$row['existencias']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="registrar" role="tabpanel" aria-labelledby="profile-tab">
        <form action="../../../backend/Productos/registrar.php" method="POST">
            <div class="row mt-3">
                <div class="col">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Pinzas">
                </div>
                <div class="col">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" placeholder="descripción breve">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="precio">precio</label>
                    <input type="number" class="form-control" name="precio" placeholder="$500">
                </div>
                <div class="col">
                    <label for="existencias">Existencias</label>
                    <input type="number" class="form-control" name="existencias" placeholder="2">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                <button type="submit" class="btn btn-success mt-3">Registrar</button>
                </div>
            </div>
        </form>
        </div>
    <div class="tab-pane fade" id="modificar" role="tabpanel" aria-labelledby="contact-tab">
    <h6>Selecciona el producto que deseas modificar</h6>
        <select id="productoSelect" onchange="redirigirAFormulario()">
            <?php
                $sql = "SELECT id FROM productos";
                $result = $conexion->query($sql);
                echo "<option>Selecciona un ID</option>";
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['id']."</option>";
                    }
                }
            ?>
        </select>
        <table class="table table-light mt-3">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Existencias</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM productos";
                    $result = $conexion->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<th scope='row'>".$row['id']."</th>";
                            echo "<td>".$row['nombre']."</td>";
                            echo "<td>".$row['descripcion']."</td>";
                            echo "<td>".$row['precio']."</td>";
                            echo "<td>".$row['existencias']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
            </table>
    </div>

    <div class="tab-pane fade" id="eliminar" role="tabpanel" aria-labelledby="contact-tab">
        <h6 class="p-3 mb-2 bg-danger text-white">
            NOTA: Al eliminar un producto, se eliminarán todas los registros de compras y ventas que se hayan realizado con ese producto.
        </h6>
        <h6>Selecciona el producto que deseas eliminar</h6>
        <form action="../../../backend/Productos/eliminar.php" method="POST">
        <select name="productosEliminar" id="productosEliminar">
            <?php
                // Consulta SQL para obtener los clientes
                $sql = "SELECT id, nombre FROM productos";
                $result = $conexion->query($sql);
                echo "<option>Productos</option>";
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                    }
                }
            ?>
        </select>
        <?php
            if($result->num_rows > 0){
                echo "<button type='submit' class='btn btn-danger mt-3 onclick='confirmacion();''>Eliminar</button>";
            } else {
                echo "<button type='submit' class='btn btn-danger mt-3' disabled>Eliminar</button>";
            }
        ?>
        <script>
            function confirmacion(){
                alert("Eliminado correctamente");
            }
        </script>
    </form>
    <table class="table table-light mt-3">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Existencias</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM productos";
                    $result = $conexion->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<th scope='row'>".$row['id']."</th>";
                            echo "<td>".$row['nombre']."</td>";
                            echo "<td>".$row['descripcion']."</td>";
                            echo "<td>".$row['precio']."</td>";
                            echo "<td>".$row['existencias']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
            </table>
    </div>
    </div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../frontend/Index/index.php"); // Redirige a la página de inicio de sesión
    exit();
}
// Conexión a la base de datos
include_once '../../../backend/conexion.php';

// Consulta SQL para obtener los clientes
$sql = "SELECT * FROM proveedores";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="./proveedores.css">
    <script type="text/javascript" src="./proveedores.js"></script>
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Proveedores</h1>
            <a href="../home.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
    <ul class="nav nav-tabs m-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#proveedores" role="tab" aria-controls="proveedores" aria-expanded="true">Proveedores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#registrar" role="tab" aria-controls="registrar" aria-expanded="false">Registrar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#modificar" role="tab" aria-controls="modificar" aria-expanded="false">Modificar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#eliminar" role="tab" aria-controls="eliminar" aria-expanded="false">Eliminar</a>
        </li>
    </ul>
    <div class="tab-content m-3" id="myTabContent">
        <div class="tab-pane fade show active" id="proveedores" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-light">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo electrónico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<th scope='row'>".$row['id']."</th>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['adress']."</td>";
                            echo "<td>".$row['phone']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="registrar" role="tabpanel" aria-labelledby="profile-tab">
        <form action="../../../backend/Proveedores/registro.php" method="POST">
            <div class="row mt-3">
                <div class="col">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre completo">
                </div>
                <div class="col">
                    <label for="adress">Dirección</label>
                    <input type="text" class="form-control" name="adress" placeholder="ingresa tu dirección">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="phone">Teléfono</label>
                    <input type="tel" class="form-control" name="phone" placeholder="ingresa tu teléfono">
                </div>
                <div class="col">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" placeholder="ingresa tu correo electrónico">
            </div>
            <div class="row mt-3">
                <div class="col">
                <button type="submit" class="btn btn-success mt-3">Registrar</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="modificar" role="tabpanel" aria-labelledby="contact-tab">
    <h6>Selecciona el proveedor que deseas modificar</h6>
        <select id="clienteSelect" onchange="redirigirAFormulario()">
            <?php
                $sql = "SELECT id FROM proveedores";
                $result = $conexion->query($sql);
                echo "<option>Selecciona un ID</option>";
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['id']."</option>";
                    }
                }
            ?>
        </select>
        <table class="table table-light mt-5">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo electrónico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM proveedores";
                    $result = $conexion->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<th scope='row'>".$row['id']."</th>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['adress']."</td>";
                            echo "<td>".$row['phone']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
            </table>
    </div>
    <div class="tab-pane fade" id="eliminar" role="tabpanel" aria-labelledby="contact-tab">
        <h6>Selecciona al proveedor que deseas eliminar</h6>
        <form action="../../../backend/Proveedores/eliminar.php" method="POST">
        <select name="proveedoresEliminar" id="proveedoresEliminar">
            <?php
                // Consulta SQL para obtener los clientes
                $sql = "SELECT id, name FROM proveedores";
                $result = $conexion->query($sql);
                echo "<option>Proveedores</option>";
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                }
            ?>
        </select>
        <?php
            if($result->num_rows > 0){
                echo "<button type='submit' class='btn btn-danger mt-3'>Eliminar</button>";
            } else {
                echo "<button type='submit' class='btn btn-danger mt-3' disabled>Eliminar</button>";
            }
        ?>
    </form>
    <table class="table table-light mt-5">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo electrónico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM proveedores";
                    $result = $conexion->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<th scope='row'>".$row['id']."</th>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['adress']."</td>";
                            echo "<td>".$row['phone']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
            </table>
    </div>
</body>
</html>

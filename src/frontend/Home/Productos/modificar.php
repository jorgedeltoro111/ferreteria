<?php
// Verifica si se ha proporcionado un id válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productoId = $_GET['id'];
    include_once "../../../backend/conexion.php";
    // Realiza una consulta SQL para obtener los datos del cliente según el $clienteId
    // y asigna los valores a las variables $nombre, $direccion, $telefono, $email
    $sql = "SELECT * FROM productos WHERE id = $productoId";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $existencias = $row['existencias'];
    } 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Productos</h1>
            <a href="../Productos/productos.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
    <form class="m-3" action="../../../backend/Productos/actualizar.php" method="POST">
            <div class="row mt-3">
                <div class="col">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" name="id" placeholder="1" value="<?php echo $productoId; ?>" readonly>
                <div class="col">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Laptop" value="<?php echo $nombre; ?>">
                </div>
                <div class="col">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" placeholder="descripción breve" value="<?php echo $descripcion; ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="precio">precio</label>
                    <input type="number" class="form-control" name="precio" placeholder="$500" value="<?php echo $precio; ?>">
                </div>
                <div class="col">
                    <label for="existencias">Existencias</label>
                    <input type="number" class="form-control" name="existencias" placeholder="2" value="<?php echo $existencias; ?>">
                </div>
            </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success mt-3">Actualizar</button>
            </div>
        </div>
    </form>
</body>
</html>

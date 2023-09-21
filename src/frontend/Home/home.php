<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../frontend/Index/index.php"); // Redirige a la página de inicio de sesión
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Ferreteria</title>
</head>
<body>
<nav class="navbar navbar-light bg-light"></nav>
  <form class="form-inline">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
    <h1 class="d-inline-block">Ferreteria</h1>
  </form>
</nav>
<div class="row row-cols-1 row-cols-md-2">
  <div class="col mb-4">
    <div class="card m-3">
      <div class="card-body">
        <h5 class="card-title">Usuarios</h5>
        <p class="card-text">Detalles de usuarios</p>
        <a href="./Usuarios/usuarios.php" class="btn btn-success">Ingresar</a>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card m-3">
      <div class="card-body">
        <h5 class="card-title">Proveedores</h5>
        <p class="card-text">Detalles de proveedores.</p>
        <a href="./Proveedores/proveedores.php" class="btn btn-success">Ingresar</a>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card m-3">
      <div class="card-body">
        <h5 class="card-title">Productos</h5>
        <p class="card-text">Detalles de productos.</p>
        <a href="./Productos/productos.php" class="btn btn-success">Ingresar</a>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card m-3">
      <div class="card-body">
        <h5 class="card-title">Ventas</h5>
        <p class="card-text">Realizar venta</p>
        <a href="./Venta/venta.php" class="btn btn-success">Ingresar</a>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card m-3">
      <div class="card-body">
        <h5 class="card-title">Compras</h5>
        <p class="card-text">Realizar compra</p>
        <a href="./Venta/venta.php" class="btn btn-success">Ingresar</a>
      </div>
    </div>
  </div>
</div>
<div class="text-center">
    <a href="../../backend/Home/cerrarSesion.php" class="btn btn-danger">Cerrar sesión</a>
</div>
</body>
</html>
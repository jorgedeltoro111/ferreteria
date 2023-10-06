<?php
// Verifica si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    // Obtiene el valor del parámetro 'id'
    $id = $_GET['id'];
    $total = $_GET['total'];
    include_once '../../../backend/conexion.php';
    // Consulta SQL para obtener la venta
} else {
    echo "No se proporcionó un valor para el atributo 'id'.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="./compra.css">
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Detalle de Compra</h1>
            <a href="./compra.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
  <hr>
  <?php
    echo "<h4 class='id_compra text-center'>ID de compra: " . $id . "</h4>";
  ?>
  <hr>
  <table class="table m-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Piezas</th>
      <th scope="col">Proveedor</th>
      <th scope="col">Precio</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT productos.nombre AS nombre_producto, 
                        detallecompras.piezas AS piezas,
                        proveedores.name AS nombre_proveedor, 
                        productos.precio AS precio
            FROM detallecompras
            INNER JOIN productos ON detallecompras.id_producto = productos.id
            INNER JOIN proveedores ON productos.id_proveedor = proveedores.id
            WHERE detallecompras.id_compra = $id";
            $result = $conexion->query($sql);
      while($row = $result->fetch_array()){
        echo "<tr>";
          echo "<td scope=row>" .  $row['nombre_producto']  ."</td>";
          echo "<td>" . $row['piezas'] . "</td>";
          echo "<td>" . $row['nombre_proveedor'] . "</td>";
          echo "<td> $"  . $row['precio'] . "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>  
    <?php
      echo "<h6 class='text-center'>Total: $" . $total . "</h6>";
    ?>
</body>
</html>

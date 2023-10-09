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
    <link rel="icon" type="image/png" href="../../../img/icon.png">
    <link type="text/css" rel="stylesheet" href="./venta.css">
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Detalle de venta</h1>
            <a href="./venta.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
  <?php
    echo "<h5 class='id_venta text-center mt-3'>ID de venta: " . $id . "</h5>";
  ?>
  <table class="table m-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Precio unitario</th>
      <th scope="col">Piezas</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Utilidad</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT productos.nombre AS nombre_producto, 
                    detalleventas.piezas AS piezas, 
                    productos.precio AS precio,
                    usuarios.usuario AS nombre_usuario,
                    detalleventas.utilidad AS utilidad
              FROM detalleventas
              INNER JOIN productos ON detalleventas.id_producto = productos.id
              INNER JOIN ventas ON detalleventas.id_venta = ventas.id
              INNER JOIN usuarios ON ventas.id_usuario = usuarios.id
              WHERE detalleventas.id_venta = $id";
      $result = $conexion->query($sql);
      $band = true;
      while($row = $result->fetch_assoc()){
        $utilidad = 0;
        $subtotal = $row['precio'] * $row['piezas'];
        $utilidad = $utilidad + ($row['utilidad'] * $row['piezas']);
        $totalPorProducto = $subtotal + $utilidad;
        echo "<tr>";
          echo "<td scope=row>" .  $row['nombre_producto']  ."</td>";
          echo "<td> $"  . $row['precio'] . "</td>";
          echo "<td>" . $row['piezas'] . "</td>";
          echo "<td>" . $subtotal . "</td>";
          echo "<td> $" . $utilidad . "</td>";
          echo "<td> $" . $totalPorProducto . "</td>";
        echo "</tr>";
        if($band){
          echo "<h5 class='text-center'>Venta realizada por: " . $row['nombre_usuario'] . "</h5>";
          $band = false;
        }
      }
    ?>
  </tbody>
</table>  
    <?php
      echo "<h6 class='total'>Total: $" . $total . "</h6>";
    ?>
</body>
</html>

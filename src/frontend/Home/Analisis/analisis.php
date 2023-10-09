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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="analisis.js"></script>
    <link rel="stylesheet" href="analisis.css">
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Análisis</h1>
            <a href="../home.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
    
    <ul class="nav nav-tabs m-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#analisis-ventas" role="tab" aria-controls="compras" aria-expanded="true">Análisis de ventas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#ranking" role="tab" aria-controls="nuevaCompra" aria-expanded="false">Ranking usuarios</a>
        </li>
    </ul>
    <div class="tab-content m-3" id="myTabContent">
        <div class="tab-pane fade show active container" id="analisis-ventas" role="tabpanel" aria-labelledby="home-tab">
            <div class="flex-container">
                <div class="h-50 w-50 grafico">
                    <h4>Gráfico de ventas</h4>
                    <canvas id="ejemplo"></canvas>
                </div>
                <aside>
                    <h4>Tabla de ventas</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Mes</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_config_idioma = "SET lc_time_names = 'es_ES'";
                            mysqli_query($conexion, $sql_config_idioma);
                            $sql = "SELECT MONTHNAME(fecha) AS mes, SUM(total) AS total FROM ventas GROUP BY MONTHNAME(fecha)";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $fila['mes'] . "</td>";
                                echo "<td>" . $fila['total'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </aside>
            </div>
        </div>
        <div class="tab-pane fade" id="ranking" role="tabpanel" aria-labelledby="profile-tab">
        </div>
    </div>
</body>
</html>

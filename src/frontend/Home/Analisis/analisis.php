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
    <script src="utilidades.js"></script>
    <script src="analisis.js"></script>
    <script src="obtenerMes.js"></script>
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
                    <canvas id="ventas"></canvas>
                    <h4>Utilidades</h4>
                    <canvas id="utilidades"></canvas>
                </div>
                <aside class="tabla-ventas">
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
                            $sql = "SELECT MONTHNAME(fecha) AS mes, SUM(total) AS total FROM ventas GROUP BY MONTHNAME(fecha) ORDER BY FIELD(mes, 'Diciembre', 'Noviembre', 'Octubre', 'Septiembre', 'Agosto', 'Julio', 'Junio', 'Mayo', 'Abril', 'Marzo', 'Febrero', 'Enero');";
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
                    <table class="table table-striped">
                        <tbody>
                                <h6 class='mt-5'>Ranking de productos vendidos en 
                                    <select id='selectMes' onchange='enviarSolicitud()'>
                                        <option value='1'>Enero</option>
                                        <option value='2'>Febrero</option>
                                        <option value='3'>Marzo</option>
                                        <option value='4'>Abril</option>
                                        <option value='5'>Mayo</option>
                                        <option value='6'>Junio</option>
                                        <option value='7'>Julio</option>
                                        <option value='8'>Agosto</option>
                                        <option value='9'>Septiembre</option>
                                        <option value='10'>Octubre</option>
                                        <option value='11'>Noviembre</option>
                                        <option value='12'>Diciembre</option>
                                </select> 
                                </h6>
                                <div id="tablaProductosContainer"></div>
                        </tbody>
                    </table>
                </aside>
            </div>
        </div>
        <div class="tab-pane fade" id="ranking" role="tabpanel" aria-labelledby="profile-tab">
            <h5 class="text-center">Ranking de usuarios</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once '../../../backend/conexion.php';
                        $sql_ranking_usuarios = "SELECT
                                usuarios.usuario AS Usuario,
                                SUM(ventas.total) AS TotalVentas
                            FROM
                                ventas
                            INNER JOIN
                                usuarios ON ventas.id_usuario = usuarios.id
                            GROUP BY
                                ventas.id_usuario, usuarios.usuario
                            ORDER BY
                                TotalVentas DESC;";

                        $resultado_ranking_usuarios = mysqli_query($conexion, $sql_ranking_usuarios);
                        while ($fila_ranking_usuarios = mysqli_fetch_assoc($resultado_ranking_usuarios)) {
                            echo "<tr>";
                            echo "<td>" . $fila_ranking_usuarios['Usuario'] . "</td>";
                            echo "<td>$" . $fila_ranking_usuarios['TotalVentas'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>                        
        </div>
    </div>
</body>
</html>

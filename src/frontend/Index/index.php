<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="../../img/icon.png">
    <link type="text/css" rel="stylesheet" href="./index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Ferreteria</title>
</head>
<body>
    <form class='containerForm' action="../../backend/Index/inicioSesion.php" method="POST">
        <h1 class="title">Ferreteria</h1>
        <?php
            include_once("../../backend/Index/error.php");
        ?>
        <div class="form-group">
            <label for="usuario"><i class="fa-solid fa-user"></i> Usuario</label>
            <input type="text" class="form-control" name="usuario" placeholder="Ingrese su usuario">
        </div>
        <div class="form-group">
            <label for="password"><i class="fa-solid fa-lock"></i> Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña">
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
</body>
</html>
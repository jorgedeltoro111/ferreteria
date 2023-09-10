<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="./clientes.css">
    <title>Ferreteria</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9JxraBgq7C5DJ6m2p9sHI9kWShIaKsvggrA&usqp=CAU" width="80" height="80" alt="">
            <h1 class="d-inline-block">Clientes</h1>
            <a href="../home.php" class="btn btn-secondary">Atrás</a>
        </form>
    </nav>
    <ul class="nav nav-tabs m-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#clientes" role="tab" aria-controls="clientes" aria-expanded="true">Clientes</a>
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
        <div class="tab-pane fade show active" id="clientes" role="tabpanel" aria-labelledby="home-tab">Listado de todos los clientes</div>
        <div class="tab-pane fade" id="registrar" role="tabpanel" aria-labelledby="profile-tab">Registrar un nuevo cliente</div>
        <div class="tab-pane fade" id="modificar" role="tabpanel" aria-labelledby="contact-tab">Modificar algun cliente</div>
        <div class="tab-pane fade" id="eliminar" role="tabpanel" aria-labelledby="contact-tab">Eliminar algun cliente</div>
    </div>
    
</body>
</html>

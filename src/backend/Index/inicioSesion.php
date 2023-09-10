<?php
    session_start();
    include("../conexion.php");
    if(isset($_POST['usuario']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $usuario = validate($_POST['usuario']); 
        $password = validate($_POST['password']);
        
        if(empty($usuario)){
            header("Location: ../../frontend/Index/index.php?error=El Usuario es requerido");
            exit();
        }else if(empty($password)){
            header("Location: ../../frontend/Index/index.php?error=La Contraseña es requerida");
            exit();
        }else{
            $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";
            $result = mysqli_query($conexion, $sql);
            if(mysqli_num_rows($result)===1){
                $row = mysqli_fetch_assoc($result);
                if($row['usuario'] === $usuario && $row['password'] === $password){
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: ../../frontend/Home/home.php");
                    exit();
                }else{
                    header("Location: ../../frontend/Index/index.php?error=Usuario o Contraseña incorrectos");
                    exit();
                }
            }else{
                header("Location: ../../frontend/Index/index.php?error=Usuario o Contraseña incorrectos");
                exit();
            }
        }
    }else{
        header("Location: ../../frontend/Index/index.php");
        exit();
    }

?>
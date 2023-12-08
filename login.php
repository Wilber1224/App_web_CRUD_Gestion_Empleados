<?php
    session_start();

    if ($_POST) {
        
        include("./bd.php");

        $usuario = $_POST["usuario"];
        $contrasenia = $_POST["contrasenia"];
    // voy a contabilizar cuantos registros hay ,count(*)... y lo voy a poner como (as)...n_usuarios dentro de la tabla...
        $sentencia = $conexion->prepare("SELECT *, COUNT(*) as n_usuarios 
            FROM `tb_usuarios` 
            WHERE usuario = :usuario 
            AND contraseña = :contrasenia");
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":contrasenia", $contrasenia);
    
        $sentencia->execute();
    
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        if($registro["n_usuarios"]>0){
            $_SESSION['usuario']=$registro["usuario"];
            $_SESSION['logueado']=true;
            header("location:index.php");

        }else{
            $mensaje="Error: El usuario o contraseña son incorrectas";
        }

    }
    



?>
<style>
        body{
            background: url(img/fondo_login.webp);            
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 1400px; 
        }
</style>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
      <!-- Bootstrap JavaScript Libraries -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                </br></br></br></br>
                <div class="card bg-transparent">
                    <div class="card-header text-center">
                        Inicio de sesión
                    </div>
                    <div class="card-body">

                        <?php if(isset($mensaje)){?>
                            <div class="alert alert-danger" role="alert">
                                <strong> <?php echo $mensaje?> </strong>
                            </div>
                        <?php }?>
                        
                        <form action="" method="post">
                            <div class="mb-3"> 
                                <!-- imagen tipo icono de usuario -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                                </svg>

                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text"
                                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Ingrese el nombre del usuario" requerid>
                            </div> 
                            <div class="mb-3">
                                <!-- icono  -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eyeglasses" viewBox="0 0 16 16">
                            <path d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A1.993 1.993 0 0 0 8 6c-.532 0-1.016.208-1.375.547zM14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                            </svg>

                              <label for="contrasenia" class="form-label">Contraseña:</label>
                              <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Ingrese su contraseña">
                            </div>    
                            
                            <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-success" type="submit">Entrar al sistema</button>
                            </div>
                        </form>

 
                </div>
            </div>
        
       
        </div>
    </div>
</body>
</html>
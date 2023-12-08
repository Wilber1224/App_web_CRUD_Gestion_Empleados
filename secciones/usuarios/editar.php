<?php
    include("../../bd.php");
    // RECEPCIONAR EL ID
    if(isset( $_GET['txtID'] )){

        $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    
        $sentencia=$conexion->prepare("SELECT * FROM tb_usuarios WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);

        $usuario=$registro["usuario"];
        $contraseña=$registro["contraseña"];
        $correo=$registro["correo"];
    
    }
    if($_POST){
        print_r($_POST);
      
          // validamos si nombredelpuesto si existe, pero si no existe: (:"") lo colocará en blanco... pero falta validarlo.
          // ERROR
          $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
          $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
          $password=(isset($_POST["password"])?$_POST["password"]:"");
          $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
      
          // preparar la inserccion de los datos
          $sentencia=$conexion->prepare("UPDATE tb_usuarios SET
            usuario=:usuario,
            contraseña=:password,
            correo=:correo
            WHERE id=:id
          ");
      
          // asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
          // bindParam: escribir la sentencia y ejecutarlo
          // ASIGNAN VALORES QUE TIENEN USO DE nombre de la :variable
          $sentencia->bindParam(":usuario",$usuario);
          $sentencia->bindParam(":password",$password);
          $sentencia->bindParam(":correo",$correo);
          $sentencia->bindParam(":id",$txtID);
          $sentencia->execute();
          $mensaje=  "Registro de Usuario actualizado </br> actualizado en la base de datos";
          header("location:index.php?mensaje=".$mensaje);
      
      
      }
?>
<?php include("../../templates/header.php"); ?> 


<br>

<style>
        body{
            background: url(fondo3.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%; 
        }
</style>
<br>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header text-center">
                        Datos del usuario
                    </div>
                    <form action="" method="post" enctype="multi/part/form-data">
                        <div class="card-body">
                            <!-- Contenido del formulario -->
                            <div class="mb-3">  
                                <label for="txtID" class="form-label">ID:</label>
                                <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nombre del usuario</label>
                                <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" required value="<?php echo $contraseña; ?>" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
                            </div>
                            <button type="submit" class="btn btn-success">Agregar</button>
                            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
                        </div>
                    </form>
                    <div class="card-footer text-muted">
                        <!-- Contenido del pie del formulario -->
                    </div>
                </div>
            </div><br>
            <div class="col-sm-4"><br><br>
    <div class="card-body d-flex align-items-center justify-content-center">
        <!-- Columna para la imagen -->
        <div class="text-center">
            <img src="../../img/images.jpg" class="img-fluid" alt="Imagen" style="max-width: 100%; height: auto;">
        </div>
    </div>
        </div>
    </div>
</div>



<?php include("../../templates/footer.php"); ?>
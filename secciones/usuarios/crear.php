<?php 
include("../../bd.php");

if($_POST){
  print_r($_POST);

    // validamos si nombredelpuesto si existe, pero si no existe: (:"") lo colocará en blanco... pero falta validarlo.
    // ERROR
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";

    // preparar la inserccion de los datos
    $sentencia=$conexion->prepare("INSERT INTO tb_usuarios (id,usuario,contraseña,correo,foto)
    VALUES (NULL,:usuario,:password,:correo,:foto)");

    // asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
    // bindParam: escribir la sentencia y ejecutarlo
    // ASIGNAN VALORES QUE TIENEN USO DE nombre de la :variable
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);

    $fecha_=new DateTime();
    // armar el nuevo nombre del archivo por la parte del tiempo para que no se sobre escriba con otros
    $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    // utilizar un archivo temporal para poder mover ese archivo temporal  a un nuevo destino que es move_uploaded_file($tmp_foto,"./.nombreArchivo_foto");
    $tmp_foto=$_FILES["foto"]["tmp_name"];

    if($tmp_foto!=''){
        move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
    }
//....... Aqui cambiamos el la foto por la variable que se hizo arriba
    $sentencia->bindParam(":foto", $nombreArchivo_foto);


    $sentencia->execute();
    // basicamente le decimos redireccioname a index.php
    // header("location:index.php");
    $mensaje=  "Usuario creado </br>  creado en la base de datos";
    header("location:index.php?mensaje=".$mensaje);


}
?>
<?php include("../../templates/header.php"); ?> 
<h3 class="text-center" >Crear Usuarios</h3>




<br/>

<style>
        body{
            background: url(fondo3.svg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%; 
        }
</style>

<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multi/part/form-data">
                
        <div class="mb-3">
          <label for="" class="form-label">Nombre del usuario</label>
          <input type="text"
            class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="nombre del usuario">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password"
            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
        </div>

        
        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <input type="file"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>

        <button type="submit" class="btn btn-success">Agregar</button>
        <!-- boton a ... por que cancelar nos llevara a la seccion anterior como es cancelación -->
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    
    </div>
</div>



<?php include("../../templates/footer.php"); ?>

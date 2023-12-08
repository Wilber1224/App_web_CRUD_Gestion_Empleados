<?php
include("../../bd.php");

if ($_POST) {
    // RECEPCIONAR DATOS
    $primer_nombre = isset($_POST["primer_nombre"]) ? $_POST["primer_nombre"] : "";
    $segundo_nombre = isset($_POST["segundo_nombre"]) ? $_POST["segundo_nombre"] : "";
    $primer_apellido = isset($_POST["primer_apellido"]) ? $_POST["primer_apellido"] : "";
    $segundo_apellido = isset($_POST["segundo_apellido"]) ? $_POST["segundo_apellido"] : "";

    $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
    $cv = isset($_FILES["cv"]["name"]) ? $_FILES["cv"]["name"] : "";

    $idpuesto = isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "";
    $fecha_de_ingreso = isset($_POST["fecha_de_ingreso"]) ? $_POST["fecha_de_ingreso"] : "";

    // PREPARAR DATOS
    $sentencia = $conexion->prepare("INSERT INTO `tb_empleados` (`id`, `primernombre`, `segundornombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idpuesto`, `fechadeingreso`)
    VALUES (NULL, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :foto, :cv, :idpuesto, :fecha_de_ingreso);");
    // REEMPLAZAR LOS DATOS ACTUALES POR LOS NUEVOS DE ARRIBA
    $sentencia->bindParam(":primer_nombre", $primer_nombre);
    $sentencia->bindParam(":segundo_nombre", $segundo_nombre);
    $sentencia->bindParam(":primer_apellido", $primer_apellido);
    $sentencia->bindParam(":segundo_apellido", $segundo_apellido);

    // ADJUNTAR FOTO Y CV PARA QUE SE REFLEJE EN LA TABLA LA FOTO
    // obtener el tiempo
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

// AHORA ADJUNTAREMOS EL PDF PARA QUE SE VEA EN EL INDEX TABLA
    $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";

    $tmp_cv=$_FILES["cv"]["tmp_name"];

    if($tmp_cv!=''){
        move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
    }

    $sentencia->bindParam(":cv", $nombreArchivo_cv);


// ......
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fecha_de_ingreso", $fecha_de_ingreso);

    $sentencia->execute();
    $mensaje=  "Registro de empleado creado </br> Se agrego a la base de datos";
    header("location:index.php?mensaje=".$mensaje);
}



$sentencia=$conexion->prepare("SELECT * FROM `tb_puestos`");
// ejecutar la instruccion de arriba 
$sentencia->execute();

$lista_tb_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php"); ?>
<br> 
<style>
        body{
            background: url(fondo3.svg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%; 
        }
</style>
<h3 class="text-center" >Datos del empleado</h3>
<div class="card">
    
    <div class="card-body">
        <!-- en este emtodo post, se usara ¨enctype¨ que nos eprmitira adjuntar archivos y "multipart/form-data nos permitira adjuntarlo, se necesitan ambos" -->
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
        <label for="primer_nombre" class="form-label">Primer Nombre</label>
        <input type="text"
            class="form-control" name="primer_nombre" id="primer_nombre" aria-describedby="helpId" placeholder="Primer nombre">
        </div>

        <div class="mb-3">
        <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
        <input type="text"
            class="form-control" name="segundo_nombre" id="segundo_nombre" aria-describedby="helpId" placeholder="segundo nombre">
        </div>


        <div class="mb-3">
        <label for="primer_apellido" class="form-label">Primer Apellido</label>
        <input type="text"
            class="form-control" name="primer_apellido" id="primer_apellido" aria-describedby="helpId" placeholder="Primer Apellido">
        </div>


        <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
        <input type="text"
            class="form-control" name="segundo_apellido" id="segundo_apellido" aria-describedby="helpId" placeholder="Segundo Apellido">
        </div>

        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <input type="file"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV (PDF):</label>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
        </div>
       

        <div class="mb-3">
            <label for="idpuesto" class="form-label">Puesto:</label>
            <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                <?php foreach ($lista_tb_puestos as $registro) { ?>

                <option value="<?php echo $registro['id']?>"> 
                <?php echo $registro['nombredelpuesto']?>
                </option>

                <?php } ?>
            </select>
            
        </div>


        <div class="mb-3">
          <label for="fecha_de_ingreso" class="form-label">Fecha de ingreso</label>
          <input type="date" class="form-control" name="fecha_de_ingreso" id="fecha_de_ingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
        </div>
    </div>
    <div class="card-footer text-muted">
    
    <button type="submit" class="btn btn-success">Aregar Registro</button>
    <a name="" id="" class="btn btn-primary" href="index.php">Cancelar</a>
    <br>

    </div>
    </form>

</div>


<?php include("../../templates/footer.php"); ?>

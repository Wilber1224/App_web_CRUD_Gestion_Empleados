<?php include("../../templates/header.php"); ?>

<?php
// TRAER EL ID DEL REGISTRO QUE QUEREMOS ACTUALIZAR Y MOSTRARLO EN EL INPUT EL ID
include("../../bd.php");
if(isset( $_GET['txtID'] )){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tb_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $primernombre=$registro ["primernombre"];
    // CORREGI AQUI EL SEGUNDO NOMBRE
    $segundonombre=$registro ["segundornombre"];
    $primerapellido=$registro ["primerapellido"];
    $segundoapellido=$registro ["segundoapellido"];

  

    $foto=$registro ["foto"];
    $cv=$registro ["cv"];

    $idpuesto=$registro ["idpuesto"];
    $fechadeingreso=$registro ["fechadeingreso"];

    $sentencia=$conexion->prepare("SELECT * FROM `tb_puestos`");
    // ejecutar la instruccion de arriba 
    $sentencia->execute();
    $lista_tb_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);


}
if ($_POST) {
    // RECEPCIONAR TODOS LOS DATOS EN CASO DE QUE EXISTA, CASO CONTRARIO NO SE PONDRA NADA "";
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $primernombre = isset($_POST["primernombre"]) ? $_POST["primernombre"] : "";
    $segundonombre = isset($_POST["segundonombre"]) ? $_POST["segundonombre"] : "";
    $primerapellido = isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "";
    $segundoapellido = isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "";

    $idpuesto = isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "";
    $fechadeingreso = isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "";
    // PREPARAR DATOS
    $sentencia = $conexion->prepare("
    UPDATE tb_empleados 
    SET
        primernombre=:primernombre,
        segundornombre=:segundornombre,
        primerapellido=:primerapellido,
        segundoapellido=:segundoapellido,
        idpuesto=:idpuesto,
        fechadeingreso=:fechadeingreso
    WHERE id=:id");
    // REEMPLAZAR LOS DATOS ACTUALES POR LOS NUEVOS DE ARRIBA
    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundornombre",$segundonombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    
    // SECCION:
    // PARA REMPLAZAR UNA FOTO QUE SE ACTUALIZO Y QUE SE CAMBIE POR LA NUEVA SIN QUEDAR BASUCA DE LA FOTO ANTERIOR

// buscamos el elemento foto, caso contrario se coloca vacio ""
    $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
// utilizamos el tiempo
    $fecha_=new DateTime();
// concatenamos el nuevo archivo de foto
    $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
// utilizamos una foto temporal
    $tmp_foto=$_FILES["foto"]["tmp_name"];

// preguntmos si es vacio, hacemos el movimiento
    if($tmp_foto!=''){
        // PREGUNTAMOS SI YA SE ENVIO UNA FOTO, HACEMOS UNA COPIA EN LA UBICACION ("./") QUE SIGNIFICA EN ESA MISMA CARPETA SE GUARDARA
        move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);

            //BUSCAMOS LA FOTO VIEJA O ANTERIOR
            $sentencia=$conexion->prepare("SELECT foto FROM `tb_empleados` WHERE id=:id");
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();
            // fetch lazy para devolver un registro
            $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
            // BORRADO DE LA FOTO
            // SI LA ENCONTRAMOS O EXISTE LA FOTO
            if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="" ){
                // PUES SE BORRA
                if(file_exists("./".$registro_recuperado["foto"])){
                    // borramos la foto localizada en esta seccion:"./".$registro_recuperado
                        unlink("./".$registro_recuperado["foto"]);
                }
            }

        //COMO YA SE BORRO. PUES AQUI SE ACTUALIZA EL NUEVO REGISTRO Y LA TABLA CORESPONDIENTE
        $sentencia = $conexion->prepare("UPDATE tb_empleados SET foto=:foto
        WHERE id=:id");
        
        $sentencia->bindParam(":foto", $nombreArchivo_foto);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }

    $cv = isset($_FILES["cv"]["name"]) ? $_FILES["cv"]["name"] : "";

    // CARGAR CV
    $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";
    $tmp_cv=$_FILES["cv"]["tmp_name"];
    if($tmp_cv!=''){
        move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
        
         // BUSCAR ARCHIVO RELACIONADO CON EL EMPLEADO foto,cv de la tabla tb_empleados
        $sentencia=$conexion->prepare("SELECT cv FROM `tb_empleados` WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        // fetch lazy para devolver un registro
        $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

         // BORRADO DEL ARCHIVO CV
    if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="" ){
        // buscamos la cv
        if(file_exists("./".$registro_recuperado["cv"])){
            // borramos la cv localizada en esta seccion:"./".$registro_recuperado
                unlink("./".$registro_recuperado["cv"]);
        }
    }
        $sentencia = $conexion->prepare("UPDATE tb_empleados SET cv=:cv
        WHERE id=:id");
        $sentencia->bindParam(":cv", $nombreArchivo_cv);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }
    
    $mensaje=  "Registro de empleado editado </br> Se actualizó en la base de datos";
    header("location:index.php?mensaje=".$mensaje);
}
?>

<br> 

<style>
        body{
            background: url(fondo3.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%; 
        }
</style>
<h3 class="text-center" >Actualizar el empledo</h3>
<div class="card">
    
    <div class="card-body">
        <!-- en este emtodo post, se usara ¨enctype¨ que nos eprmitira adjuntar archivos y "multipart/form-data nos permitira adjuntarlo, se necesitan ambos" -->
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input type="text"
        value="<?php echo $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

        <div class="mb-3">
        <label for="primernombre" class="form-label">Primer Nombre:</label>
        <input type="text"

        value="<?php echo $primernombre;?>"
            class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre">
        </div>
<!-- CORREGIR SEGUNDO NOMBRE NO APARECE EN EL INPUT -->

    

        <div class="mb-3">
        <label for="primerapellido" class="form-label">Primer Apellido</label>
        <input type="text"

        value="<?php echo $primerapellido;?>"
            class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer Apellido">
        </div>


        <div class="mb-3">
        <label for="segundoapellido" class="form-label">Segundo Apellido</label>
        <input type="text"

        value="<?php echo $segundoapellido;?>"
            class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
        </div>

        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <br/>
          <img width="100" src="<?php echo $foto;?>" class="img-fluid rounded" alt="">
          <br>
          <br>
          <input type="file"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>

        
        <div class="mb-3">
          <label for="cv" class="form-label">CV (PDF):</label>
          <br/>
           <a href="<?php echo $cv;?>"><?php echo $cv;?></a>
           <br>
           <br>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
        </div>
        

        <div class="mb-3">
            <label for="idpuesto" class="form-label">Puesto:</label>
            <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                <?php foreach ($lista_tb_puestos as $registro) { ?>

                <option <?php echo ($idpuesto==$registro['id'])?"selected":"";?> value="<?php echo $registro['id']?>"> 
                <?php echo $registro['nombredelpuesto']?>
                </option>

                <?php } ?>
            </select>
            
        </div>

        <div class="mb-3">
          <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
          <input type="date"

          value="<?php echo $fechadeingreso;?>"

          class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
        </div>
    </div>
    <div class="card-footer text-muted">
    
    <button type="submit" class="btn btn-success">Actualizar Registro</button>
    <a name="" id="" class="btn btn-primary" href="index.php">Cancelar</a>
    <br>

    </div>
    </form>

</div>





<?php include("../../templates/footer.php"); ?>
<?php include("../../templates/header.php"); ?> 

<?php 
// conectramos la conexión que se habia hecho a la BD en (bd.php), solo traemos la conexión con este incluide.
include("../../bd.php");
// sentencia if y ($_POST) por que estamos recibiendo datos
if($_POST){
    print_r($_POST);
    // validamos si nombredelpuesto si existe, pero si no existe: (:"") lo colocará en blanco... pero falta validarlo.
    // ERROR
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    // preparar la inserccion de los datos
    $sentencia=$conexion->prepare("INSERT INTO tb_puestos(id,nombredelpuesto)
            VALUES (null, :nombredelpuesto)");
    // asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
    // bindParam: escribir la sentencia y ejecutarlo
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->execute();

    $mensaje=  "Registro agregado";
    header("location:index.php?mensaje=".$mensaje);
}
?>

<h3 class="text-center" >Crear Puestos</h3>

<?php include("../../templates/footer.php"); ?>
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
        Puestos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multi/part/form-data">
                
        <div class="mb-3">
          <label for="" class="form-label">Nombre del puesto</label>
          <input type="text"
            class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="nombre del puesto">
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
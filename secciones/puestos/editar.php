<?php
include("../../bd.php");
if(isset( $_GET['txtID'] )){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tb_puestos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto=$registro["nombredelpuesto"];

}
if($_POST){
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";

    // validamos si nombredelpuesto si existe, pero si no existe: (:"") lo colocará en blanco... pero falta validarlo.
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    // preparar la inserccion de los datos
    $sentencia=$conexion->prepare("UPDATE tb_puestos SET nombredelpuesto=:nombredelpuesto
    WHERE id=:id");
    // asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
    // bindParam: escribir la sentencia y ejecutarlo
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje=  "Se actualizó el registro";
    header("location:index.php?mensaje=".$mensaje);


}

?>

<?php include("../../templates/header.php"); ?> 
<br/>

<style>
        body{
            background: url(fondo3.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%; 
        }
</style>
<br><br>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
<div class="card">
    <div class="card-header">
        Editar Puestos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multi/part/form-data">

            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text"
              value="<?php echo $txtID;?>"
              
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>
                <!-- readonly solo es de lectura el de arriba -->
        <div class="mb-3">
          <label for="" class="form-label">Nombre del puesto</label>
          <input type="text"
          value="<?php echo $nombredelpuesto;?>"

            class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="nombre del puesto">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <!-- boton a ... por que cancelar nos llevara a la seccion anterior como es cancelación -->
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    
    </div>
</div>



<?php include("../../templates/footer.php"); ?>
<?php include("../../templates/header.php"); ?> 


<?php
// conectramos la conexión que se habia hecho a la BD en (bd.php), solo traemos la conexión con este incluide.
include("../../bd.php");
// usar conexion para preparar una sentencia para mostrar los registros de la BD


// INSTRUCCION DE BORRADO
// si recibimos un dato
if(isset( $_GET['txtID'] )){
    // vamos a almacenar el id
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    // vamos a preparar una instruccion SQL
    $sentencia=$conexion->prepare("DELETE FROM tb_puestos WHERE id=:id");
    // vamos a pasar un parametro para el borrado 
    $sentencia->bindParam(":id",$txtID);
    // y finalmente borramos
    $sentencia->execute();
    $mensaje=  "Registro eliminado </br> registro eliminado de la base de datos";
    header("location:index.php?mensaje=".$mensaje);

}

$sentencia=$conexion->prepare("SELECT * FROM `tb_puestos`");
// ejecutar la instruccion de arriba 
$sentencia->execute();
// la lista va a tener todo los registros ($sentencia)... Y fetchAll(PDO::FETCH_ASSOC) sirve para recuperar todos los resultados de la consulta de arriba (("SELECT * FROM tb_puestos"))
// basicamente para no invocar cada columna, mejor se recupera con fetchAll... todos las columnas de tb_puestos
$lista_tb_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

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
        <div class="col-md-20">
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-info" href="crear.php" role="button">Agregar Puesto</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">Id puesto</th>
                <th scope="col">Nombre del puesto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- leer la tabla de puestos como un registro -->
            <!-- La estructura foreach permite recorrer fácilmente todos los elementos de un array o un objeto iterable sin tener que preocuparse por la implementación detallada del bucle luego se imprimira  cada uno en una nueva línea. -->
            <?php foreach ($lista_tb_puestos as $registro) { ?>
            <!-- consultar datos de la BD -->

                <tr class="">
                <td scope="row"><?php  echo $registro['id']; ?></td>
                <td><?php  echo $registro['nombredelpuesto']; ?></td>
                <td > 
                    <a class="btn btn-info" href="editar.php?txtID=<?php  echo $registro['id']; ?>" role="button">Editar</a>
                    <a class="btn btn-danger" href="javascript:borrar(<?php  echo $registro['id']; ?>);" role="button">Eliminar</a>
                </td>
                </tr>
            
            <?php } ?>
           

        </tbody>
    </table>
</div>
    </div>
    </div>
    </div>

</div>

<?php include("../../templates/footer.php"); ?>
<?php include("../../bd.php");

// INSTRUCCION DE BORRADO
// si recibimos un dato
if(isset( $_GET['txtID'] )){
    // vamos a almacenar el id
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    
    // vamos a preparar una instruccion SQL
    $sentencia=$conexion->prepare("DELETE FROM tb_usuarios WHERE id=:id");
    // vamos a pasar un parametro para el borrado 
    $sentencia->bindParam(":id",$txtID);
    // y finalmente borramos
    $sentencia->execute();
    $mensaje=  "Usuario eliminado </br> Usuario eliminado de la base de datos";
    header("location:index.php?mensaje=".$mensaje);

}

$sentencia=$conexion->prepare("SELECT * FROM `tb_usuarios`");
// ejecutar la instruccion de arriba 
$sentencia->execute();
// la lista va a tener todo los registros ($sentencia)... Y fetchAll(PDO::FETCH_ASSOC) sirve para recuperar todos los resultados de la consulta de arriba (("SELECT * FROM tb_puestos"))
// basicamente para no invocar cada columna, mejor se recupera con fetchAll... todos las columnas de tb_puestos
$lista_tb_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
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
<br><br><br>
<!--  bg-transparent: propiedad de bootstrap para tabla transparente -->
<div class="card ">
    <div class="card-header">
    <a name="" id="" class="btn btn-info" href="crear.php" role="button">Agregar Usuario</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($lista_tb_usuarios as $registro) { ?>

                <tr class="">
            
                    <td scope="row"> <?php  echo $registro['id']; ?> </td>
                    <td> <?php  echo $registro['usuario']; ?> </td>
                    <td> <?php  echo $registro['contraseña']; ?> </td>
                    <td> <?php  echo $registro['correo']; ?> </td>
                    <td> 
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




<?php include("../../templates/footer.php"); ?>
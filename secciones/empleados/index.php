<?php
include("../../bd.php");
// INSTRUCCION DE BORRADO
// si recibimos un dato
if(isset( $_GET['txtID'] )){
    // vamos a almacenar el id
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    // BUSCAR ARCHIVO RELACIONADO CON EL EMPLEADO foto,cv de la tabla tb_empleados
    $sentencia=$conexion->prepare("SELECT foto,cv FROM `tb_empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    // fetch lazy para devolver un registro
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    // BORRADO DE LA FOTO
    // Estamos buscando si existe la foto
    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="" ){
        // buscamos la foto
        if(file_exists("./".$registro_recuperado["foto"])){
            // borramos la foto localizada en esta seccion:"./".$registro_recuperado
                unlink("./".$registro_recuperado["foto"]);
        }
    }
    // BORRADO DEL ARCHIVO CV
    if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="" ){
        // buscamos la cv
        if(file_exists("./".$registro_recuperado["cv"])){
            // borramos la cv localizada en esta seccion:"./".$registro_recuperado
                unlink("./".$registro_recuperado["cv"]);
        }
    }

    
    // vamos a preparar una instruccion SQL
    $sentencia=$conexion->prepare("DELETE FROM tb_empleados WHERE id=:id");
    // vamos a pasar un parametro para el borrado 
    $sentencia->bindParam(":id",$txtID);
    // y finalmente borramos
    $sentencia->execute();
    $mensaje=  "Registro eliminado </br> registro eliminado de la base de datos";
    header("location:index.php?mensaje=".$mensaje);
    
}

// despues de * y coma, estamos haciendo una subconsulta, en donde le decimos que seleccione la fila nombredel puesto de la BD de la tabla tb_puestos cuando(WHERE) tb_puestos.id sea igual a tb_empleados.idpuesto id puesto es la columna de la BD y lo vas a mostrar como un unico registro(limit 1) lo vas a mostrar (as) como puesto. El as le esta diciendo que toda la centencia anterior de ella, equivale a un dato que se llame puesto. Esto no altera el por *.... Se debe cambiar el idpuesto por puesto abajo en la columna de idpuesto. ahora el usuario no vera el ID numero si no el valor de ese ID osea su nombre puesto.
$sentencia=$conexion->prepare("SELECT *,
(SELECT nombredelpuesto  FROM tb_puestos WHERE tb_puestos.id=tb_empleados.idpuesto limit 1) as puesto
FROM `tb_empleados`");
// ejecutar la instruccion de arriba 
$sentencia->execute();
// la lista va a tener todo los registros ($sentencia)... Y fetchAll(PDO::FETCH_ASSOC) sirve para recuperar todos los resultados de la consulta de arriba (("SELECT * FROM tb_puestos"))
// basicamente para no invocar cada columna, mejor se recupera con fetchAll... todos las columnas de tb_puestos
$lista_tb_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>
<?php include("../../templates/header.php"); ?> 
<br/>
<br/>
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
    <div class="card-header">
        
        <a name="" id="" class="btn btn-info" href="crear.php" role="button">Agregar Empleado</a>
    </div>
    <div class="card-body">
     <div class="table-responsive-sm">
        <table class="table" id="tabla_id">
            <thead>
                <!-- columna -->
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <!-- <th scope="col">Foto</th> -->
                    <th scope="col">CV</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Fecha de ingreso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- fila -->

                <?php foreach ($lista_tb_empleados as $registro) { ?>

                <tr class="">
                    <td scope="row"> <?php  echo $registro['id']; ?> </td>
                    <!-- Aqui estamos concatenando el primero nombre, segundo nombre, primer y segundo apellido, para que se reflejen dos columnas de la BD en una fila aqui. -->
                    <td scope="row"> 
                        <?php  echo $registro['primernombre']; ?>
                        <?php  echo $registro['segundornombre']; ?>
                        <?php  echo $registro['primerapellido']; ?>
                        <?php  echo $registro['segundoapellido']; ?>
                    </td>

                    <!-- comente la foto -->
                    <!-- <td>

                        <img width="50" src="<?php echo $registro['foto']; ?>" class="img-fluid rounded" alt="">

                    </td> -->

                    <td> 
                        <a href=" <?php  echo $registro['cv']; ?>" target="_blank">
                        <?php  echo $registro['cv']; ?>
                        </a> 
                    </td>

                    <td> <?php  echo $registro['puesto']; ?> </td>
                    <td> <?php  echo $registro['fechadeingreso']; ?> </td> </td>
                    <td>
                    <a href="carta_recomendacion.php?txtID=<?php  echo $registro['id']; ?>" class="btn btn-primary" role="button">Carta</a>
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
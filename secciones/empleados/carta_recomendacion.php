<?php
include("../../bd.php");

if(isset( $_GET['txtID'] )){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *, (SELECT nombredelpuesto  FROM tb_puestos WHERE tb_puestos.id=tb_empleados.idpuesto limit 1) as puesto FROM tb_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $primernombre=$registro ["primernombre"];
    $segundonombre=$registro ["segundornombre"];
    $primerapellido=$registro ["primerapellido"];
    $segundoapellido=$registro ["segundoapellido"];

        // hicimos una variable y concatenamos el nombre completo de la persona x.
        $NombreCompleto=$primernombre." ". $segundonombre." ". $primerapellido." ". $segundoapellido;


    $foto=$registro ["foto"];
    $cv=$registro ["cv"];
    $idpuesto=$registro ["idpuesto"];
    $puesto=$registro ["puesto"];
    $fechadeingreso=$registro ["fechadeingreso"];

    $fechaInicio=new DateTime($fechadeingreso);
    $fechaFin=new DateTime(date('Y-m-d'));
    $diferencia=date_diff($fechaInicio,$fechaFin);
}
// Cuando se coloca esto, es para decir que todo lo de abajo se va a recolectar y se alacenara en esta variable de abajo $HTML=ob_clean();
ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendación</title>
</head>
<body>
    <h1 align=center>CARTA DE RECOMENDACIÓN LABORAL</h1>
    <br><br>
    <p align=right>México, Tabasco. a <strong> <?php echo date('d M Y');?></strong> </p>
    
    <p>A quién Corresponda <br>
    <br/>
    Presente</p>
    <br>
    <style>
        .parrafo{
            text-align: justify;
        }
    </style>
    <!-- $diferencia->y significa la diferencia de un año ->y -->
    <p class="parrafo">Es un placer tener la oportunidad de recomendar al Sr. <strong> <?php echo $NombreCompleto; ?> </strong> para el puesto de <strong> <?php echo $puesto;?> </strong> en su empresa de renombre <strong>XPACE</strong> Yo era su supervisor inmediato aquí en la empresa FIGMA y había trabajado con él durante <strong> <?php echo $diferencia->y; ?> </strong>  año(s).
    </p>

    <p class="parrafo">Somos una empresa de software muy pequeña pero exitosa, sin espacio para el avance profesional de <strong><?php echo $NombreCompleto; ?></strong> en este momento. Por lo tanto, desea mudarse a una empresa de software más grande con proyectos más desafiantes y espacio para el crecimiento profesional. Entonces, quiero apoyarlo en su búsqueda para ascender en la carrera con esta carta de recomendación.
    </p>

    <p class="parrafo"><strong> <?php echo $NombreCompleto; ?> </strong> es sincero y apasionado por resolver problemas relacionados con el cliente y escribir código mientras trabaja en nuestro departamento de software. Tiene un potencial tremendo y respeta a sus superiores mientras aborda con entusiasmo todas las asignaciones. Es una persona amigable, tranquila y muy apreciada por todos nuestros compañeros de trabajo y clientes.
    </p>

    <p class="parrafo">Por lo tanto, espero que lo considere para un trabajo como<strong> <?php echo $puesto;?> </strong> de su empresa. Confío en que podrá afrontar cualquier reto que le ofrezcas y creo que quedarás muy satisfecho con su trabajo e ideas únicas.
    No dude en ponerse en contacto conmigo si tiene alguna pregunta o desea hablar sobre él a través de mi teléfono <strong>932 102 8199</strong> o mi identificación de correo personal <strong>Jhoacin Escolástico Sánchez</strong>. Estaré muy feliz si puedo ayudarlo con sus inquietudes.
    </p>
    <p class="parrafo">Espero que le guste esta recomendación y le dé a  <strong> <?php echo $NombreCompleto; ?></strong> una oportunidad en su empresa.
    </p>
    <br><br><br><br>
    <p>_______________________________ <br> Atentamente </br>
    Jhoacin Escolastico Sanchez
    </p>

</body>
</html>
<?php
// SECCION GENERADOR DE LA CARTA EN PDF
// esta variable recolecta el documento de arriba
$HTML=ob_get_clean();

require_once("../../libs/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf= new Dompdf();
// declaramos las opciones
$opciones=$dompdf->getOptions();

// permite ver todos los archivos
$opciones->set(array("isRemoteEnabled"=>true));

// activar las opciones que se hizo anteriormente arriba
$dompdf->setOptions($opciones);

// crear un documento HTML con una variable HTML
$dompdf->loadHtml($HTML);

// formato del papel o tipo del papel
$dompdf->setPaper('letter');

// para renderizar
$dompdf->render();

// adjuntar archivo...Attachment nos permite descargar el archivo
$dompdf->stream("archivo.pdf", array("Attachment"=>false));

?>
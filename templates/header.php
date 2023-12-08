<!-- SECCION PARA QUE A HUEVO SE REGISTRE EL USUARIO Y NO PUEDA ACCEDER AL SISTEMA POR EL URL -->
<?php
    session_start();
    // variable absoluta de direccion de aplicacionweb1
    $url_base = "http://localhost/App_web_CRUD_Gestion_Empleados/";

    // si no existe un usuario
if(!isset($_SESSION['usuario'])){
    // que se joda y que se redirija al login 
    header("location:".$url_base."login.php");
}
?>
<!-- Empezar escribiendo bs5-$ y en automatico escribira todo lo de abajo gracias a la
extension de bootstrap -->

<!doctype html>
<html lang="es">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- jQuery Core 3.7.0 minified -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

    <!-- PARA ALERT SweetAlert3 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-danger">
        
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">

                <li class="nav-item">
                    <a class="navbar-brand" href="<?php echo $url_base;?>index.php" aria-current="page"> Inicio <span class="visually-hidden"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $url_base;?>secciones/empleados" aria-current="page">Empleados <span class="visually-hidden"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $url_base;?>secciones/puestos" aria-current="page">Puestos <span class="visually-hidden"></span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $url_base;?>secciones/usuarios" aria-current="page">Usuarios <span class="visually-hidden"></span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $url_base;?>cerrar.php" aria-current="page">Cerrar Sesión <span class="visually-hidden"></span></a>
                </li>
                
            </ul>
        </div>
    </nav>

  <main class="container">
<!-- SECCION mensaje de alerta para boton de accion -->
  <?php
 if (isset($_GET['mensaje'])){ ?>
 <script>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
 </script>
 <?php }?>
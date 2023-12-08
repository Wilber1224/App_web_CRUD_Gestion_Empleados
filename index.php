<!-- Aqui estamos conectando el codigo del header osea el menu a esta plantilla al igual que footer abajo -->
<?php include("templates/header.php"); ?> 
<style>
        body{
            background: url(fondo.svg);            
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 90% 140%; 
        }
</style>


    <div class="p-2 mb-5 rounded-1">
        <div class="container-fluid py-1">
          <h1 class="display-5 fw-bold text-center">Bienvenido/a al sistema </br> usuario: <?php echo  $_SESSION['usuario']?> </h1>
        </div>
    </div>
      
      <?php include("templates/footer.php"); ?>

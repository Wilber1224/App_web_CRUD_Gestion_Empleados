<?php
// cuando se visite esta seccion del menu, se abrira esta sesion
    session_start();
    // se destruira la sesion
    session_destroy();
    // ya destruida nos redirecionara automaticamente al login
    header("location:./login.php");
?>
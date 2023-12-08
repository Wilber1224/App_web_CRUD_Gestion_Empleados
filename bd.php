<?php
//CONEXION A LA BASE DE DATOS

$servidor="localhost"; // 127.0.0.1
$baseDeDatos="aplicacionweb01"; //nombre de la BD
$usuario="root"; //usuario root por que es local
$contraseña="";

try{ //con try estamos guardando de alguna forma todos los problemas que pudiera tener y si
    // no lo tiene, se conecta y capturar la conexion.
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contraseña);
}catch(Exception $ex){
    echo $ex->getMessage(); // aqui si hay error, lo arrojara con este echo
}


?>
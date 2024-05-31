<?php

$servidor = "localhost"; 
$baseDeDatos = "appempleadospuestos";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
} catch (Exception $e) {
    echo $e->getMessage();
}


?>
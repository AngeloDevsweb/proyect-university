<?php 
    // conexion a  la base de datos

$host = "localhost";
$bd = "sitio";
$usuario = "root";
$contraseña = "";

try {
    //code...
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña);
    // if($conexion){
    //     echo "conectando .... a sistema";
    // }
} catch (Exception $ex) {
    //throw $th;
    echo $ex->getMessage();
}
?>
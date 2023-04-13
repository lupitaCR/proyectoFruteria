<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    #capturamos los datos del formulario
    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $precio=$_POST['precio'];
    $archivo=$_FILES['archivo'];
    $nombreArchivo=$archivo['name'];
    $categoria=explode('.',$nombreArchivo)[1];
    $fecha=date('Y-m-d G:i:s');
    
    #archivo
    $tmp=$archivo['tmp_name'];
    $contenido=file_get_contents($tmp);
    $archivoBLOB=addslashes($contenido);

    #conexion y función insertar
    include "../config/conexion.php";
    $conexion=conexion();
    $query=insertarArchivo($conexion,$nombre,$descripcion,$precio,$categoria,$fecha,$archivoBLOB);
    if($query){
        header('location:../productos.php?insertar=success');
    }else{
        header('location:../productos.php?insertar=error');
    }
}

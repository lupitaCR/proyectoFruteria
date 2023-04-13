<?php 
    $id=$_GET['id'];
    #conexion
    include '../config/conexion.php';
    $conexion=conexion();
    #eliminar
    $query=eliminarArchivo($conexion,$id);
    if($query){
        header('location:../productos.php?eliminar=success');
    }else{
        header('location:../productos.php?eliminar=error');
    }


?>
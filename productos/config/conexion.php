<?php 
    // Initialize the session
    session_start();
    if($_SESSION["loggedin"] && $_SESSION["loggedin"] === true){
        if($_SESSION["username"] == 'frute_lacosecha@gmail.com'){
        }else{
          header("location: ../../usuarios/inicioUsuario.php");
          exit;
        }
        
      }
    function conexion(){
        $conexion=mysqli_connect('localhost','root','','fruteria');
        return $conexion;
    }
    function listarArchivos($conexion){
        $sql="SELECT * FROM productos";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario ingreso al apartado de consultas'; 
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
    function eliminarArchivo($conexion,$id){
        $sql="DELETE FROM productos where id=$id";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario elimino un registro';
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
    function insertarArchivo($conexion,$nombre,$descripcion,$precio,$categoria,$fecha,$archivoBlob){
        $sql="INSERT INTO productos(nombre,descripcion,precio,categoria,fecha,archivo) VALUES('$nombre','$descripcion','$precio','$categoria','$fecha','$archivoBlob') ";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario agrego un nuevo registro';
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
    function seleccionarCampo($conexion,$id){
        $sql="SELECT * FROM productos WHERE id=$id";
        $query=mysqli_query($conexion,$sql);
        $datos=mysqli_fetch_assoc($query);
        return $datos;
    }
    function modificarNombre($conexion,$id,$nombre){
        $sql="UPDATE productos SET nombre='$nombre' WHERE id=$id";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario modifico el nombre de un registro';
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
    function modificarDescripcion($conexion,$id,$descripcion){
        $sql="UPDATE productos SET descripcion='$descripcion'WHERE id=$id";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario modifico la descripcion de un registro';
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
    function modificarPrecio($conexion,$id,$precio){
        $sql="UPDATE productos SET precio='$precio' WHERE id=$id";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario modifico el nombre de un registro';
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
    function modificarTodo($id,$conexion,$nombre,$descripcion,$precio,$categoria,$fecha,$archivoBlob){
        $sql="UPDATE productos SET nombre='$nombre',descripcion='$descripcion',precio='$precio',categoria='$categoria',fecha='$fecha',archivo='$archivoBlob' WHERE id=$id";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario modifico un registro';
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
    function modificarArchivo($conexion,$id,$categoria,$fecha,$archivoBlob){
        $sql="UPDATE productos SET categoria='$categoria',fecha='$fecha',archivo='$archivoBlob' WHERE id=$id ";
        $query=mysqli_query($conexion,$sql);
        $id = $_SESSION["id"];
        $fecha = date('Y-m-d');
        $descripcion = 'El usuario modifico el nombre de un registro';
        $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
        mysqli_query($conexion,$sqlLog);
        return $query;
    }
?>
<?php 

#optener el id
$id=$_GET['id'];
#sacar el nombre del archivo y la extensión
include 'config/conexion.php';
$conexion=conexion();
$datos=seleccionarCampo($conexion,$id);
$nombre=$datos['nombre'];
$descripcion=$datos['descripcion'];
$precio=$datos['precio'];
$categoria=$datos['categoria'];
$titulo=strtoupper($nombre.'.'.$categoria);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <title>La cosecha</title>
    <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/frutas.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /><link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Poppins:wght@200&family=Rubik:wght@300&display=swap" rel="stylesheet">
</head>

</head>
<body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <a><img src="../img/frutas.png" width="30" height="30" class="d-inline-block align-top" alt=""></a>
            <a class="navbar-brand menu" href="index.html">Frute La cosecha</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="./productos.php">Producto</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./logout.php">Cerrar sesión</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <script async src="https://cse.google.com/cse.js?cx=a7e662fb69526427c">
                </script>
                <div class="gcse-search"></div>
              </form>
            </div>
        </nav>
    </div>
    </div>
  <br>
  <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                   <h2 class="mt-4 texto">Modificar producto</h2>
                </center>
                <hr>
                <div class="m-0 row justify-content-center mt-3" >
                <form action="acciones/modificar.php" method="post" enctype="multipart/form-data" class="col-auto w-50">
                    <div class="alert alert-warning text-center">
                        <?php echo $titulo;?>
                    </div>
                    <input type="hidden" name="id" value="<?=$id?>">
                    <label for="Nombre">Nombre del producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre;?>">
                    <label for="Nombre">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion;?>">
                    <label for="Nombre">Precio</label>
                    <input type="number" minLength="0" name="precio" id="precio" class="form-control" value="<?php echo $precio;?>">
                   <!--  <label for="archivo">Actualizar Archivo</label>
                    <input type="file" name="archivo" id="archivo" class="form-control"> -->
                    <button type="submit" class="btn btn-danger btn-block mt-2">Actualizar</button> <a href="../productos/productos.php"><button type="button" class="btn btn-block btn-success mt-2">Regresar</button></a>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->    
    <script src="/prueba2/prueba/java/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
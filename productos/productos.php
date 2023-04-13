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
  <br>

    <div class="container d-flex" style="text-align: right;">
      <div class="col-12 align-self-end">
        <button title="Agregar" alt="Agregar" type="button"  class="btn btn-success"> <a href="/proyecto/productos/insertar.php" style="color:#faf8f8;" ><span  class="material-symbols-outlined">
          add_circle
          </span>
        </a></button>
      </div>
    </div>
   
<br>
    <div class="container">
        <div class="row m-0 justify-content-center mt-5">
            <table class="table col-auto w-100">
                <thead>
                    <tr>
                        <th colspan="7" class="text-center">LISTA DE PRODUCTOS SUBIDOS</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Nombre del producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Fecha ingresada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        include "config/conexion.php";
                        $conexion=conexion();
                        $lista=listarArchivos($conexion);
                        $contador=0;
                        while($datos=mysqli_fetch_array($lista)){
                            $contador++;
                            $id=$datos['id'];
                            $nombre=$datos['nombre'];
                            $descripcion=$datos['descripcion'];
                            $precio=$datos['precio'];
                            $categoria=$datos['categoria'];
                            $archivo=$datos['archivo'];
                            $fecha=$datos['fecha'];
                            $mensage='';
                            if($categoria=='png' || $categoria=='jpg'|| $categoria=='jpeg'){
                                $mensage="<td><img class='icono' src='data:image/jpg;base64,".base64_encode($archivo)."' ></td>";
                            }
                            if($categoria=='pdf'){
                                $mensage="<td><a href='cargar.php?id=$id'><img class='icono' src='img/pdf.png'></br>Abrir</a></td>";
                            }
                            if($categoria=='rar' || $categoria=='zip'){
                                $mensage="<td><a class='text-center' href='cargar.php?id=$id'><img class='icono ' src='img/comprimido.jpg'><br>Descargar</a></td>";
                            }
                            if($categoria=='xls'){
                                $mensage="<td><a class='text-center'  href='cargar.php?id=$id'><img class='icono' src='img/exel.png'><br>descargar</a></td>";
                            }
                            if($categoria=='docx'){
                                $mensage="<td><a class='text-center' href='cargar.php?id=$id'><img class='icono' src='img/word.png'><br>descargar</a></td>";
                            }
                            if($mensage==''){
                                $mensage="<td><a class='text-aling-center' href='cargar.php?id=$id'><img class='icono' src='img/desconocido.png'><br>descargar</a></td>";
                            }
                    ?>
                    <tr>
                        <td><?=$contador; ?></td>
                        <td><?=$nombre; ?></td>
                        <td><?=$descripcion; ?></td>
                        <td><?=$precio; ?></td>
                        <?php 
                            echo $mensage;
                        ?>
                        <td><?=$fecha; ?></td>
                        <td><a class="btn btn-success" href="modificar.php?id=<?=$id?>">Editar</a> <a class="btn btn-danger" style="color:white;" data-toggle="modal" data-target="#exampleModal">Eliminar</a></td>
                    </tr>
                    <?php 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          ¿Estas seguro de eliminar el registro?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            <a class="btn btn-danger" href="acciones/eliminar.php?id=<?=$id;?>">Eliminar</a>
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
<?php
 session_start();
 if($_SESSION["loggedin"] && $_SESSION["loggedin"] === true){
     if($_SESSION["username"] == 'frute_lacosecha@gmail.com'){
       header("location: ../productos/productos.php");
       exit;
     }else{
     }
     
   }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Inicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilos/style.css">
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
    <div class="container">
            <?php 
                include('conn.php');
                $query = "SELECT * FROM productos";
                $resultado = $conexion->query($query);
                while($row=$resultado->fetch_assoc()){
                    ?>
                    <div class="card">
                            <img src="data:image/jpg;base64,<?php echo base64_encode($row['archivo']);?>">
                            <h4><?php echo $row['nombre'];?></h4>
                            <p><?php echo $row['descripcion'];?></p>
                            <p><?php echo $row['precio'];?></p>
                        </div>
                       
                    <?php
                }
            ?>
    </div>
  </body> 
    <script src="https://cdn.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
<?php
// Initialize the session
session_start();

/******FUNCION PARA RECAPTCHA***** */
function verificarToken($token, $claveSecreta)
{
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos),
        ),
    );
    $contexto = stream_context_create($opciones);
    $resultado = file_get_contents($url, false, $contexto);
    if ($resultado === false) {
        return false;
    }
    $resultado = json_decode($resultado);
    $pruebaPasada = $resultado->success;
    return $pruebaPasada;
}
/************************* */
require_once "database.php";

$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){

        define("CLAVE_SECRETA", "6Le3fH0lAAAAAGo-A_VcAvu1nKjodrh6mruKqfc7");

        if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
            $password_err = "Debes completar el captcha";
        }
        $token = $_POST["g-recaptcha-response"];
        $verificado = verificarToken($token, CLAVE_SECRETA);

        if ($verificado) {
            $sql = "SELECT id_us, username, password FROM usuarios WHERE username = ?";
            $sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES (?, ?, ?)";
            
            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                $param_username = $username;
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                if($stmt = mysqli_prepare($conexion, $sqlLog)){
                                    echo 'conexion a log correcta';
                                    mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_fecha, $param_descripcion);
                                    
                                    $param_id = $id;
                                    $param_fecha = date('Y-m-d');
                                    $param_descripcion = 'El usuario inicio sesion';
                                    
                                    if(mysqli_stmt_execute($stmt)){
                                        session_start();
                                
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;

                                        if($_SESSION["username"] == 'frute_lacosecha@gmail.com'){
                                            header("location: ../productos/productos.php");
                                        }else{
                                            header("location: ../usuarios/inicioUsuario.php");
                                        }
                                        
                                    } else{
                                        echo "Algo salió mal, por favor inténtalo de nuevo.";
                                    }                               
                                }                            
                                 
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "La contraseña que has ingresado no es válida.";
                            }
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                    }
                } else{
                    echo "Algo salió mal, por favor vuelve a intentarlo.";
                }
            }
        } else {
            $password_err = "Debes completar el captcha para iniciar sesión";

        }
    }
    // Close connection
    mysqli_close($conexion);
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>La cosecha</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/frutas.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   </head>
  <body>
  <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <h3 class="text-center titulo">Iniciar sesión</h3>
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label for="username" class="text-success">Correo</label><br>
                            <input type="email" onkeypress="return ((event.charCode != 59) && (event.charCode != 45) && (event.charCode != 39))" type="text" name="username" class="form-control">
                            <span class="help-block text-warning"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label for="password" class="text-success">Contraseña</label><br>
                                <input type="password" name="password" class="form-control">
                                <span class="help-block text-warning"><?php echo $password_err; ?></span>
                            </div>
                            
                            <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="6Le3fH0lAAAAAGzt1HbAEaRmM3RNFU0a1tdR077j"></div><br>
                            <div class="form-group">
                                <center>
                                    <button type="submit" name="submit" class="btn boton btn-lg btn-block text-light" >Iniciar sesión</button>
                                </center>
                            </div><br>
                            <p class="text-light text-center">¿No tienes una cuenta?, <a href="../registro/registro.php">Registrate aquí</a>!!</p><br>
                            <center>
                                    <a type="button" href="../index.html" class="btn btn-success btn-lg btn-block text-light" >Regresar</a>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
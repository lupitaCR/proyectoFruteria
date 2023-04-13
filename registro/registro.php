<?php
// Include config file
require_once "database.php";
// Define variables and initialize with empty values
$username = '';
$username_err = '';
$password = '';
$password_err = '';
$lastName = '';
$lastName_err = '';
$firstName = '';
$firstName_err = '';
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id_us FROM usuarios WHERE username = ?";
        
        if($stmt = mysqli_prepare($conexion, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este usuario ya fue tomado.";
                } else{
                    echo 'validacion correcta';
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate firstName
    if(empty(trim($_POST["firstName"]))){
        $firstName_err = "Por favor ingrese un nombre.";
    } else{
        $firstName = trim($_POST["firstName"]);
    }

    // Validate lastName
    if(empty(trim($_POST["lastName"]))){
        $lastName_err = "Por favor ingrese al menos un apellido.";
    } else{
        $lastName = trim($_POST["lastName"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($firstName_err) && empty($lastName_err)){
        
        // Prepare an insert statement
        $sql1 = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $sql2 = "INSERT INTO datospersonales (nombre, apellidos) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conexion, $sql1)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                if($stmt = mysqli_prepare($conexion, $sql2)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ss", $param_firstName, $param_lastName);
                    
                    // Set parameters
                    $param_firstName = $firstName;
                    $param_lastName = $lastName;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Redirect to login page
                        header("location: ../login/login.php");
                    } else{
                        echo "Algo salió mal, por favor inténtalo de nuevo.";
                    }
                }
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
          
        // Close statement
        mysqli_stmt_close($stmt);
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
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
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
                        <form id="login-form" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <h3 class="text-center titulo">Registro</h3>
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label for="username" class="text-success">Correo</label><br>
                                <input type="email" onkeypress="return ((event.charCode != 59) && (event.charCode != 45) && (event.charCode != 39))"
                                name="username" class="form-control" value="<?php echo $username; ?>" maxlength="50">
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label for="password" class="text-success">Contraseña</label><br>
                                <input type="password" onkeypress="return ((event.charCode != 59) && (event.charCode != 45) && (event.charCode != 39))"
                                name="password" class="form-control" value="<?php echo $password; ?>" maxlength="10">
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="text-success">Nombre</label><br>
                                <input type="text" name="firstName" onkeypress="return ((event.charCode != 59) && (event.charCode != 45) && (event.charCode != 39))"
                                class="form-control" value="<?php echo $firstName; ?>" maxlength="20">
                                <span class="help-block"><?php echo $firstName_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="text-success">Apellidos</label><br>
                                <input type="text" name="lastName" onkeypress="return ((event.charCode != 59) && (event.charCode != 45) && (event.charCode != 39))"
                                 class="form-control" value="<?php echo $lastName; ?>" maxlength="30">
                                 <span class="help-block"><?php echo $lastName_err; ?></span>
                            </div>
                            <div class="form-group">
                                <center>
                                    <button type="submit" name="submit" class="btn boton btn-md btn-block text-light" >Registrarse</button>
                                </center>
                            </div> <br>
                            <p class="text-light text-center"> ¿Ya tienes una cuenta?, <a href="../login/login.php">Ingresa aquí</a>.</p><br>
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
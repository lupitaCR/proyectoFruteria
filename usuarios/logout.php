<?php
// Initialize the session
session_start();
$id = $_SESSION["id"];
$fecha = date('Y-m-d');
$descripcion = 'El usuario cerro sesion';
$sqlLog = "INSERT INTO logs (id_us, fecha, descripcion) VALUES ('$id','$fecha','$descripcion')";
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: ../login/login.php");
exit;
?>
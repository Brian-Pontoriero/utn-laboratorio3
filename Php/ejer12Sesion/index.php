<?php
    session_start();

    if (!isset($_SESSION['idSesion'])) {
       
        header("Location:./ingresoAlSistema.php");
        exit();
    }

    // Redireccionar al formulario de inicio de sesión
    header("Location:./formularioDeLogin.html");

?>


<?php
    session_start();

    // Verificar si hay una sesión establecida
    if (!isset($_SESSION['idSesion'])) {
       
        header("Location:./ingresoAlSistema.php");
        exit();
    }

    // Redireccionar al formulario de inicio de sesión
    header("Location:./formularioDeLogin.html");
    exit();

?>


<?php
    session_start();

    // Verificar si hay una sesión establecida
    if (isset($_SESSION['login'])) {
    // Redireccionar a la aplicación
    header("Location: app/index.php");
    exit();
    }

    // Redireccionar al formulario de inicio de sesión
    header("Location: formularioDeLogin.html");
    exit();
?>


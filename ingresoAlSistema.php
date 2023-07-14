<?php
session_start();
include('manejoSesion.php');

// Verificar si hay una sesión establecida
if (isset($_SESSION['login'])) {
    // Redireccionar a la aplicación
    header("Location: app/index.php");
    exit();
}

// Obtener los datos de login y password enviados desde el formularioDeLogin.html
$login = $_POST['login'];
$password = $_POST['password'];

// Realizar la autenticación del usuario
$autenticado = autenticarUsuario($login, $password);

if (!$autenticado) {
    // Redireccionar al formulario de inicio de sesión o mostrar mensaje de rechazo
    header("Location: formularioDeLogin.html");
    exit();
}

// Autenticación exitosa
header("Location: app/index.php");
exit();
?>
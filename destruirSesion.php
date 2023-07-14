<?php
session_start();

// Destruir la sesión
session_destroy();

// Redireccionar al formulario de inicio de sesión
header("Location: formularioDeLogin.html");
exit();
?>
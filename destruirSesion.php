<?php
    session_start();

    if (!isset($_SESSION['idSesion'])) {
        header("Location: ./formularioDeLogin.html");
        exit();
    }

    session_destroy();
    header("Location: ./formularioDeLogin.html");
    exit();
?>
<?php

    include("./database.php");

    session_start(); // reanuda o crea una nueva sesion

    if (!isset($_SESSION['idSesion'])) {  // si es null, comprueba si esta inicializada

        if (!isset($_POST['var1']) || !isset($_POST['var2'])) {
            header('Location:./formularioDeLogin.html');
            exit();
        }

        $login = $_POST['var1'];
        $password = $_POST['var2'];
        $autenticado = false;
        $hashedpass= md5($password);
        $sql = "SELECT * FROM usuarios WHERE login = :login AND password = :password;";

        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $hashedpass);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        $objUser = new stdClass();

        if ($stmt->rowCount()) { //devuelve 0 o cantidad de filas dependiendo de la respuesta de la consulta, si esta vacía o no.
            $autenticado = true;

            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $objUser->login = $fila['login'];
                $objUser->cont = $fila['sesiones'];
            }

            $objUser->cont++;

            $sql = "UPDATE usuarios SET sesiones = :cont WHERE login = :login;";

            $stmt = $dbh->prepare($sql);

            $stmt->bindParam(':cont', $objUser->cont);
            $stmt->bindParam(':login', $objUser->login);

            $stmt->execute();
        }

        if (!$autenticado) {
            header('Location:./formularioDeLogin.html');
            exit();
        }

        $_SESSION['idSesion'] = session_create_id();
        $_SESSION['usuario'] = $login;
        $_SESSION['clave'] = $password;
        $_SESSION['contador'] = $objUser->cont;
    }

    echo "<h1>Acceso concedido</h1>";
    echo "<h2>Sus parámetros de sesión son:</h2>";

    echo "<h3>Id de sesión: " . $_SESSION['idSesion'] . "</h3>";
    echo "<h3>User: " . $_SESSION['usuario'] . "</h3>";
    echo "<h3>Contador: " . $_SESSION['contador'] . "</h3>";

    echo "<p><button onClick=\"location.href='./app/index.php'\">Ingresar a la app</button></p>";
    echo "<p><button onClick=\"location.href='./destruirSesion.php'\">Cerrar sesión</button></p>";

?>
<?php
session_start();

function autenticarUsuario($login, $password) {
    include('database.php');

    $query = "SELECT login, password, sesiones FROM usuarios WHERE login = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$login]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['password'] === md5($password)) {
        $_SESSION['login'] = $row['login'];
        $_SESSION['sesiones'] = $row['sesiones'];

        // Incrementar contador en la base de datos
        $updateQuery = "UPDATE usuarios SET sesiones = sesiones + 1 WHERE login = ?";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute([$login]);

        return true;
    } else {
        return false;
    }
}
?>
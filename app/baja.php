<?php
    
    include("../manejoSesion.php");

    include ("./database.php");

    if ( isset($_POST['codArt']) ) {
    
        try
        {
            $dsn = "mysql:host=$host;dbname=$dbname"; 
            $dbh = new PDO($dsn, $user, $password);

            $codArt = $_POST["codArt"];

            $sql = "DELETE FROM articulos WHERE codArt = :codArt";
            $stmt = $dbh->prepare($sql);
            $respuesta_estado = $respuesta_estado . "\nPreparación exitosa.";
            $stmt->bindParam(':codArt', $codArt);
            $respuesta_estado = $respuesta_estado . "\nBinding exitoso.";
            $stmt->execute();
            $respuesta_estado = $respuesta_estado . "\nEjecución exitosa.";

            $respuesta_estado = $respuesta_estado . "\nEl artículo ha sido dado de baja. Vuelva a cargar los datos para visualizar los cambios.";
            echo $respuesta_estado;
        }
        catch (PDOException $e)
        {
            $respuesta_estado = $respuesta_estado . "\nERROR: \n" . $e->getMessage();
            echo $respuesta_estado;
        }
    }
    else{
        header("Location:./index.php");
    }
?>
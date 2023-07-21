<?php

    include ("./database.php");

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $dbh = new PDO($dsn, $user, $password); /*Database Handle*/
        $respuesta_estado = $respuesta_estado . "\nConexión exitosa";

        $codArt = $_GET["codArt"];

        $sql = "SELECT * FROM articulos WHERE codArt = :codArt";        

        $stmt = $dbh->prepare($sql);
        //Vinculacion de sentencia:
        $stmt->bindParam(':codArt', $codArt);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $fila = $stmt->fetch();

        $objArticulo = new stdClass();
        $objArticulo->codArt=$fila['codArt'];
        $objArticulo->familia=$fila['familia'];
        $objArticulo->descripcion=$fila['descripcion'];
        $objArticulo->um=$fila['um'];
        $objArticulo->fechaAlta=$fila['fechaAlta'];
        $objArticulo->saldoStock=$fila['saldoStock'];

        $salidaJson = json_encode($objArticulo);
        $dbh = null;

        sleep(1);
        echo $salidaJson;
    } 
    catch (PDOException $e) {
        // Manejo de excepciones y escritura en el archivo de log de errores
        $puntero = fopen("./errores.log", "a");
        $fecha = date("Y-m-d");
        fwrite($puntero, date("Y-m-d H:i") . " "); // Fecha y hora del error
        fwrite($puntero, $e->getMessage()); // Mensaje de error de la excepción
        fwrite($puntero, "\n");
        fclose($puntero);

        // Opcionalmente, mostrar un mensaje de error al usuario
        echo "Ha ocurrido un error. Por favor, intenta nuevamente más tarde.";
    }
?>
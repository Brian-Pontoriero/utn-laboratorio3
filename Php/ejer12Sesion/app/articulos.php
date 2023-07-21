<?php

    include("../manejoSesion.php");

    include ("./database.php");

    if (isset($_GET["orden"])){

        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $dbh = new PDO($dsn, $user, $password); /*Database Handle*/
            $respuesta_estado = $respuesta_estado . "\nConexión exitosa";

            $orden = $_GET["orden"];
            $filtroCodArt = $_GET["filtroCodArt"];
            $filtroFamilia = $_GET["filtroFamilia"];
            $filtroUm = $_GET["filtroUm"];
            $filtroDescripcion = $_GET["filtroDescripcion"];
            $filtroFechaAlta = $_GET["filtroFechaAlta"]; 

            $sql="SELECT * FROM articulos WHERE ";
            $sql=$sql . "codArt LIKE CONCAT('%',:codArt,'%') and "; //ojo con espacios antes y despues del and
            $sql=$sql . "familia LIKE CONCAT('%',:familia,'%') and ";
            $sql=$sql . "descripcion LIKE CONCAT('%',:descripcion,'%') and ";
            $sql=$sql . "um LIKE CONCAT('%',:um,'%') and ";
            $sql=$sql . "fechaAlta LIKE CONCAT('%',:fechaAlta,'%')";
            $sql=$sql . " ORDER BY $orden";

            //$sql = "SELECT * FROM articulos WHERE codArt LIKE CONCAT('%',:codArt,'%') AND familia LIKE CONCAT('%',:familia,'%') AND descripcion LIKE CONCAT('%',:descripcion ,'%') AND um LIKE CONCAT('%',:um ,'%') AND fechaAlta LIKE CONCAT('%',:fechaAlta ,'%') ORDER BY $orden";

            $stmt = $dbh->prepare($sql);
            //Vinculacion de sentencia:
            $stmt->bindParam(':codArt', $filtroCodArt);
            $stmt->bindParam(':familia', $filtroFamilia);
            $stmt->bindParam(':descripcion', $filtroDescripcion);
            $stmt->bindParam(':um', $filtroUm);
            $stmt->bindParam(':fechaAlta', $filtroFechaAlta);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            $articulos=[];

            while($fila = $stmt->fetch()) {
                $objArticulo = new stdClass();
                $objArticulo->codArt=$fila['codArt'];
                $objArticulo->familia=$fila['familia'];
                $objArticulo->descripcion=$fila['descripcion'];
                $objArticulo->um=$fila['um'];
                $objArticulo->fechaAlta=$fila['fechaAlta'];
                $objArticulo->saldoStock=$fila['saldoStock'];
                array_push($articulos,$objArticulo);
            }

            $objArticulos = new stdClass();
            $objArticulos->articulos=$articulos;
            $objArticulos->cuenta=count($articulos);
            $salidaJson = json_encode($objArticulos);
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
    }
    else{
        header("Location:./index.php");
    }
?>
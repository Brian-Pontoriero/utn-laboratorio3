<?php
    sleep(3); //Algunos segundos de delay
    
    $objFormulario = new stdClass;
    
    $objFormulario->idUsuario = $_POST["idUsuario"];
    $objFormulario->login = $_POST["login"];
    $objFormulario->apellido = $_POST["apellido"];
    $objFormulario->nombres = $_POST["nombres"];
    $objFormulario->fechaNac = $_POST["fecha"];

    $jsonObjFormulario = json_encode($objFormulario);

    echo "<br><h3>Resultado de la transformación a Json en el servidor:</h3>";
    echo $jsonObjFormulario;
?>
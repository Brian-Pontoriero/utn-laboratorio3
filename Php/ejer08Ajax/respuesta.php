<?php
    sleep(3); //Algunos segundos de delay
    
    $variableAEncriptar = $_POST["clave"];

    echo "Clave: " . $variableAEncriptar . "<br><br>";
    
    echo "Clave encriptada en md5 (128 bits o 16 pares hexadecimales):<br>";
    $claveEncriptada = md5($variableAEncriptar);
    echo $claveEncriptada;

    echo "<br><br>";

    echo "Clave encriptada en sha1 (160 bits o 20 pares hexadecimales):<br>";
    $claveEncriptada = sha1($variableAEncriptar);
    echo $claveEncriptada;
?>
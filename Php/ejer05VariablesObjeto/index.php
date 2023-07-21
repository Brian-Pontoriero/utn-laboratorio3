<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables de tipo objeto</title>
    <style>
        p{
            color: blue;
            display: inline;
        }
    </style>
</head>
<body>
    <?php
        echo "<h2>Variables tipo objeto de PHP. Objeto renglon de pedido</h2>";
        
        $objRenglonPedido = new stdClass;

        $objRenglonPedido->codArt = "cp001";
        $objRenglonPedido->descripcionArt = "Jurel 800 gr";
        $objRenglonPedido->precioUnitario = 2000;
        $objRenglonPedido->cantidad = 2;

        $objRenglonPedido2 = new stdClass;

        $objRenglonPedido2->codArt = "cp002";
        $objRenglonPedido2->descripcionArt = "Atun 600 gr";
        $objRenglonPedido2->precioUnitario = 3100;
        $objRenglonPedido2->cantidad = 3;

        echo "<h2><p>\$objRenglonPedido</p></h2>";
        echo "Código artículo: $objRenglonPedido->codArt<br>";
        echo "Descripción del artículo: $objRenglonPedido->descripcionArt<br>";
        echo "Precio unitario: $$objRenglonPedido->precioUnitario<br>";
        echo "Cantidad: $objRenglonPedido->cantidad<br>";

        echo "<h2>Tipo de <p>\$objRenglonPedido:</p> " . gettype($objRenglonPedido) . "</h2>";

        echo "<h2>Definamos arreglo de pedidos:</h2>";

        $renglonesPedido = [];
        array_push($renglonesPedido, $objRenglonPedido);
        array_push($renglonesPedido, $objRenglonPedido2);

        echo "<h2><p>\$renglonesPedido</p></h2>";
        echo "<h2>Tabula <p>\$renglonesPedido</p>. Recorrer el arreglo de renglones y tabularlos con html:</h2>";

        echo "<table>";
        foreach ($renglonesPedido as $renglon) {
            echo "<tr>";
            echo "<td>$renglon->codArt</td>";
            echo "<td>$renglon->descripcionArt</td>";
            echo "<td>$renglon->precioUnitario</td>";
            echo "<td>$renglon->cantidad</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<h2>Cantidad de renglones: " . count($renglonesPedido) . "</h2>";
        
        echo "<h2>Producción de un objeto <p>\$renglonesPedido</p> con dos atributos array renglonesPedido y cantidadDeRenglones</h2>";
        
        $objRenglonesPedido = new stdClass();

        $objRenglonesPedido->renglonesPedido=$renglonesPedido;
        $objRenglonesPedido->cantidadDeRenglones = count($renglonesPedido);

        echo "Cantidad de renglones: $objRenglonesPedido->cantidadDeRenglones";

        echo "<h2>Producción de un JSON jsonRenglones:</h2>";

        $jsonRenglonesPedido = json_encode($objRenglonesPedido);
        echo $jsonRenglonesPedido;
    ?>
</body>
</html>
<?php

    include("../manejoSesion.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos ABM</title>
    <style>
        html, body
        {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #contenedor
        {
            width: 100%;
            height: 100%;
            background-color: darkgray;
        }

        h1 {
            position: absolute;
            top: 25%;
            left: 10%;
            font-size:1.8em;
            display: block;
        }

        table
        {
            display: block;
            height: 80%;
            width: 100%;
            border-collapse: collapse;
            overflow: auto;
        }

        tbody
        {
            overflow: scroll;
        }

        header
        {
            height: 10%;
            width: 100%;
            font-weight: bold;
            background-color: lightyellow;
            display: flex;
            align-items: center;
            justify-content: end;
            position: relative;
        }

        footer{
            background-color: lightyellow;
            width: 100%;
            height: 10%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left_div{
            position: absolute;
            top: 40%;
            left: 2%;
        }

        th
        {
            text-align: center;
            background-color: coral;
            padding: 1%;
            box-sizing: border-box;
            border-style: solid;
            border-color: rgb(216, 120, 56);
            cursor: pointer;
            border-width: 2px;
        }

        thead {
            position: sticky;
            top: 0;
        }

        #orden{
            padding: 1%;
            width: 50%;
        }

        [campo-dato = "codArt"],
        [campo-dato = "familia"],
        [campo-dato = "um"],
        [campo-dato = "descripcion"],
        [campo-dato = "saldoStock"],
        [campo-dato = "fechaAlta"],
        [campo-dato = "PDF"],
        [campo-dato = "modif"],
        [campo-dato = "baja"] {
            width: calc(100%/9);
        }

        tbody tr:nth-child(odd)
        {
            background: rgba(0, 0, 0, 0.2);
        }

        tbody td
        {
            padding: 1.5%;
        }

        .botonHeader
        {
            padding: 1%;
            width: calc(100%/5.4);
        }

        .boton
        {
            display: block;
            padding: 1%;
            width: 100%;
            text-align: center;
        }

        #opciones
        {
            display: flex;
            align-items: center;
            justify-content: end;
            position: relative;
            width: 85%;
            height: 100%;

        }


        #titulo
        {
            background-color: black;
            color: white;
            height: 10%;
            width: 100%;
            padding-left: 10px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .opcion
        {
            float: left;
            height: 30%;
            width: 50%;
        }

        thead input, thead select
        {
            display: block;
            width: 80%;
            padding: 1%;
            margin: auto;
        }

        .modalVisible
        {
            visibility: visible;
        }

        .modalInvisible
        {
            visibility: hidden;
        }

        #modalModif, #modalAlta
        {
            position: fixed;
            top: 20%;
            left: 25%;
            padding: 20px;
            z-index: 10;
            width: 50%;
        }

        #modalRespuesta
        {
            position: fixed;
            top: 30%;
            left: 30%;
            box-sizing: border-box;
            width: 45%;
            height: auto;
            background-color:rgb(195, 64, 16);
            z-index: 11;
        }

        #textoRespuesta
        {
            padding: 5%;
            box-sizing: border-box;
            color: white;
            font-weight: bold;
        }

        #formModalModif, #formModalAlta
        {
            width: 100%;
            background-color: dimgray;
            display: flex;
            flex-wrap: wrap;
            height: 340px;
            overflow: auto;
            color: white;
        }

        .entrada
        {
            width: 70%;
            padding: 2%;
            box-sizing: border-box;
        }

        .entrada input, .entrada select
        {
            display: block;
            width: 70%;
            padding: 1%;
            box-sizing: border-box;
        }

        .encabezado
        {
            height: 10%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            background-color: black;
            color: white;
            padding: 1%;
            box-sizing: border-box;
        }

        #salirModif, #salirAlta, #salirRespuesta
        {
            cursor: pointer;
            color: red;
        }

        .contenedorBloqueado
        {
            pointer-events: none;
            opacity: 0.7;
        }

        .contenedorDesbloqueado
        {
            pointer-events: all;
            opacity: 1;
        }

        .input-field, .select-field {
            width: 100%;
        }
        .centrado{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        @media (max-width: 900px)
        {
            [campo-dato = "codArt"],
            [campo-dato = "familia"],
            [campo-dato = "PDF"],
            [campo-dato = "modif"],
            [campo-dato = "baja"] {
                width: calc(100%/5);
            }

            [campo-dato = "um"],
            [campo-dato = "descripcion"],
            [campo-dato = "saldoStock"],
            [campo-dato = "fechaAlta"]{
                display: none;
            }

            header h1{
                display: none;
            }

            .boton{
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div id="contenedor">
        <header>
            <h1>Artículos</h1>
            <div id="opciones">
                <div>
                    <label for="orden">Orden:</label>
                    <input type="text" readonly id="orden" value="codArt">
                </div> 
                <div>
                    <button class="botonHeader" id="cargar">Cargar Datos</button>
                    <button class="botonHeader" id="vaciar">Vaciar Datos</button>
                    <button class="botonHeader" id="vaciarFiltros">Limpiar Filtros</button>
                    <button class="botonHeader" id="alta">Alta Registro</button>
                    <button class="botonHeader" id="cerrarSesion">Cerrar Sesion</button>
                </div>
            </div>
        </header>

        <table>
            <thead>
                <tr>
                    <th campo-dato="codArt" id="thCodArt">Cód. Art</th>
                    <th campo-dato="familia" id="thFamilia">Familia</th>
                    <th campo-dato="um" id="thUm">UM</th>
                    <th campo-dato="descripcion" id="thDescripcion">Descripción</th>
                    <th campo-dato="saldoStock" id="thSaldoStock">Saldo stock</th>
                    <th campo-dato="fechaAlta" id="thFechaAlta">Fecha alta</th>
                    <th campo-dato="PDF" id="thFechaAlta">PDF's</th>
                    <th campo-dato="modif" id="thFechaAlta">Modi</th>
                    <th campo-dato="baja" id="thFechaAlta">Bajas</th>
                </tr>
                <tr>
                    <td campo-dato="codArt">
                        <input id="filtroCodArt" type="text" class="input-field">
                    </td>
                    <td campo-dato="familia">
                        <select name="filtroFamilia" id="filtroFamilia" class="select-field">
                            <option value=""></option>
                        </select>
                    </td>
                    <td campo-dato="um" >
                        <input id="filtroUm" type="text" class="input-field">
                    </td>
                    <td campo-dato="descripcion" >
                        <input  id="filtroDescripcion" type="text" class="input-field">
                    </td>
                    <td campo-dato="saldoStock" >
                        <input id="filtroSaldoStock" type="text" class="input-field">
                    </td>
                    <td campo-dato="fechaAlta">
                        <input id="filtroFechaAlta" type="text" class="input-field">
                    </td>
                    <td campo-dato="PDF"></td>
                    <td campo-dato="modif"></td>
                    <td campo-dato="baja"></td> 
                </tr>
            </thead>
            <tbody id="tabla">
            </tbody>
        </table>
        <footer>
            <div id="totalRegistros" class="left_div">
            </div> 
            Pie
        </footer>  
    </div>



    <div id="modalModif" class="modalInvisible">
        <div class="encabezado">
            <div>Modificar Artículo</div>
            <button id="salirModif">X</button>
        </div>

        <form  id="formModalModif" method="post" enctype="multipart/form-data">
            <div class="entrada">
                <label for="codArtModif">codArt: </label>
                <input type="text" id="codArtModif" name="codArtModif" required readonly>
            </div>
            <div class="entrada">
                <label for="familiaModif">Familia: </label>
                <select id="familiaModif" name="familiaModif" required></select>
            </div>
            <div class="entrada">
                <label for="umModif">UM: </label>
                <input type="text" id="umModif" name="umModif" required readonly>
            </div>
            <div class="entrada">
                <label for="descripcionModif">Descripción: </label>
                <input type="text" id="descripcionModif" name="descripcionModif" required>
            </div>
            <div class="entrada">
                <label for="saldoStockModif">saldoStock: </label>
                <input type="text" id="saldoStockModif" name="saldoStockModif" required> 
            </div>
            <div class="entrada">
                <label for="fechaAltaModif">FechaAlta: </label>
                <input type="text" id="fechaAltaModif" name="fechaAltaModif" required>
            </div>
            <div class="entrada">
                <label> Documento Pdf: </label>
                <input type="file" id="pdfModif" name="pdfModif">
            </div>
            <div class="entrada">
                <input type="button" value="Modificar" id="enviarModif">
            </div>
        </form>
    </div>



    <div id="modalAlta" class="modalInvisible">
        <div class="encabezado">
            <div>Alta Artículo</div>
            <button id="salirAlta">X</button>
        </div>
        <form id="formModalAlta" method="post" enctype="multipart/form-data">
            <div class="entrada">
                <label for="codArtAlta">codArt: </label>
                <input type="text" id="codArtAlta" name="codArtAlta" placeholder="Cód: AAA000" pattern="[A-Za-z]{3}[0-9]{3}" required>
            </div>
            <div class="entrada">
                <label for="familiaAlta">Familia: </label>
                <select name="familiaAlta" id="familiaAlta" required></select>
            </div>
            <div class="entrada">
                <label for="umAlta">UM: </label>
                <input type="text" id="umAlta" name="umAlta" required>
            </div>
            <div class="entrada">
                <label for="descripcionAlta">Descripción: </label>
                <input type="text" id="descripcionAlta" name="descripcionAlta" required>
            </div>
            <div class="entrada">
                <label for="saldoStockAlta">saldoStock: </label>
                <input type="text" id="saldoStockAlta" name="saldoStockAlta" required> 
            </div>
            <div class="entrada">
                <label for="fechaAlta_Alta">Fecha alta: </label>
                <input type="text" id="fechaAlta_Alta" name="fechaAlta_Alta" required>
            </div>
            <div class="entrada">
                <label> Documento Pdf: </label>
                <input type="file" id="pdfAlta" name="pdfAlta">
            </div>
            <div class="entrada">
                <input type="button" value="Alta" id="enviarAlta">
            </div>
        </form>
    </div>

    

    <div id="modalRespuesta" class="modalInvisible">
        <div class="encabezado">
            <div>Respuesta del servidor</div>
            <button id="salirRespuesta">X</button>
        </div>
        <div id="textoRespuesta" class="centrado">
            Respuesta del servidor
        </div>
    </div>
</body>
</html>

<script src="./jQuery.js"></script>
<script>

    function cargarDesplegable()
    {
        var desplegable = $("#filtroFamilia");
        var desplegableModif = $("#familiaModif");
        var desplegableAlta = $("#familiaAlta");

        $.ajax({
            type: "get",
            url:"./familias.php",
            success: function(respuestaServer)
            {
                alert(respuestaServer);
                var objRespuesta = JSON.parse(respuestaServer);
                objRespuesta.familias.forEach(function(argValor, argIndice){
           
                    var opcion = document.createElement("option");
                    var opcionModif = document.createElement("option");
                    var opcionAlta = document.createElement("option");

                    opcion.innerHTML = argValor.nombre;
                    opcionModif.innerHTML = argValor.nombre;
                    opcionAlta.innerHTML = argValor.nombre;

                    desplegable.append(opcion);
                    desplegableModif.append(opcionModif);
                    desplegableAlta.append(opcionAlta);
                });
            }
        });
    }

    function cargarModif(codArt)
    {
        $.ajax({
                type: "get",
                url: "./salidaJsonArticulo.php",
                data: { codArt: codArt },
                success: function (respuestaDelServer) {
                    objetoDato = JSON.parse(respuestaDelServer);
                    $("#codArtModif").val(objetoDato.codArt);
                    $("#familiaModif").val(objetoDato.familia);
                    $("#umModif").val(objetoDato.um);
                    $("#descripcionModif").val(objetoDato.descripcion);
                    $("#saldoStockModif").val(objetoDato.saldoStock);
                    $("#fechaAltaModif").val(objetoDato.fechaAlta);
                }
            });
    }

    function modificar()
    {
        var datos = new FormData($("#formModalModif")[0]);
        $.ajax({
            type: "post",
            method: "post",
            enctype: "multipart/form-data",
            url: "./modificar.php",
            processData: false,
            contentType: false,
            cache: false,
            data: datos,
            success: function(respuesta)
            {
                document.getElementById("modalRespuesta").className = "ModalVisible";
                document.getElementById("textoRespuesta").innerText = respuesta;
            }
        })

    }

    function cargarPDF(codArt)
    {
        $.ajax({
            type: "get",
            url: "./pdf.php",
            data: {codArt: codArt},
            success: function(respuestaServer)
            {
                $("#textoRespuesta").empty();
                var objetoDato = JSON.parse(respuestaServer);
                document.getElementById("modalRespuesta").className = "ModalVisible";
                $("#textoRespuesta").html("<iframe width='auto' height='300px' src='data:application/pdf;base64," + objetoDato.documentoPDF + "'></iframe>");
            }
        })
    }

    function alta()
    {
        var datos = new FormData($("#formModalAlta")[0]);
        $.ajax({
            type: "post",
            method: "post",
            enctype: "multipart/form-data",
            url: "./alta.php",
            processData: false,
            contentType: false,
            cache: false,
            data: datos, 
            success: function(respuesta)
            {
                // alert(respuesta);
                document.getElementById("modalRespuesta").className = "ModalVisible";
                document.getElementById("textoRespuesta").innerHTML = respuesta;
            }
        })
    }

    function baja($codArt)
    {
        $.ajax({
            type: "post",
            url: "./baja.php",
            data: {codArt: $codArt},
            success: function(respuesta)
            {
                document.getElementById("modalRespuesta").className = "ModalVisible";
                document.getElementById("textoRespuesta").innerHTML = respuesta;
            }
        });
    }

    function vaciarCampos()
    {
        $("#codArtAlta").val("");
        $("#umAlta").val("");
        $("#descripcionAlta").val("");
        $("#saldoStockAlta").val("");
        $("#fechaAlta_Alta").val("");
        $("#pdfAlta").val("");

        $("#codArtModif").val("");
        $("#umModif").val("");
        $("#descripcionModif").val("");
        $("#saldoStockModif").val("");
        $("#fechaAltaModif").val("");
        $("#pdfModif").val("");
    }

    function habilitarAlta()
    {
        if(document.getElementById("formModalAlta").checkValidity() == true)
        {
            $("#enviarAlta").attr("disabled", false);
        }
        else
        {
            $("#enviarAlta").attr("disabled", true);
        }
    }

    function habilitarModif()
    {
        if(document.getElementById("formModalModif").checkValidity() == true)
        {
            $("#enviarModif").attr("disabled", false);
        }
        else
        {
            $("#enviarModif").attr("disabled", true);
        }
    }

    function cargaDatos()
    {
        $.ajax({
            type: "get",
            url:"./articulos.php",
            data: { 
                orden: $("#orden").val(), 
                filtroCodArt: $("#filtroCodArt").val(),
                filtroFamilia: $("#filtroFamilia").val(),
                filtroUm: $("#filtroUm").val(),
                filtroDescripcion: $("#filtroDescripcion").val(),
                filtroSaldoStock: $("#filtroSaldoStock").val(),
                filtroFechaAlta: $("#filtroFechaAlta").val()
            },
            success: function(respuestaServer){
                
                $("#tabla").empty();
                var objJson = JSON.parse(respuestaServer);

                objJson.articulos.forEach(function(valor, indice)
                {
                    var objTr = document.createElement("tr");
                    var tdCodArt = document.createElement("td");
                    var tdFamilia = document.createElement("td");
                    var tdUm = document.createElement("td");
                    var tdDescripcion = document.createElement("td");
                    var tdSaldoStock = document.createElement("td");
                    var tdFechaAlta = document.createElement("td");
                    var tdPDF = document.createElement("td");
                    var tdModif = document.createElement("td");
                    var tdBaja = document.createElement("td");
                    
                    tdCodArt.setAttribute("campo-dato", "codArt");
                    tdFamilia.setAttribute("campo-dato", "familia");
                    tdUm.setAttribute("campo-dato", "um");
                    tdDescripcion.setAttribute("campo-dato", "descripcion");
                    tdSaldoStock.setAttribute("campo-dato", "saldoStock");
                    tdFechaAlta.setAttribute("campo-dato", "fechaAlta");
                    tdPDF.setAttribute("campo-dato", "PDF");
                    tdModif.setAttribute("campo-dato", "modif");
                    tdBaja.setAttribute("campo-dato", "baja");

                    tdCodArt.innerHTML = valor.codArt;
                    objTr.appendChild(tdCodArt);
                    tdFamilia.innerHTML = valor.familia;
                    objTr.appendChild(tdFamilia);
                    tdUm.innerHTML = valor.um;
                    objTr.appendChild(tdUm);
                    tdDescripcion.innerHTML = valor.descripcion;
                    objTr.appendChild(tdDescripcion);
                    tdSaldoStock.innerHTML = valor.saldoStock;
                    objTr.appendChild(tdSaldoStock);
                    tdFechaAlta.innerHTML = valor.fechaAlta;
                    objTr.appendChild(tdFechaAlta);

                    tdPDF.innerHTML = "<button class='boton' campo-dato='PDF'>PDF</button>";
                    objTr.appendChild(tdPDF);
                    tdModif.innerHTML = `<button class='boton' campo-dato='modif'>Modificar</button>`;
                    objTr.appendChild(tdModif);
                    tdBaja.innerHTML = `<button class='boton' campo-dato='baja'>Baja</button>`;
                    objTr.appendChild(tdBaja);
                    
                    tdPDF.onclick = function(){
                        cargarPDF(valor.codArt);
                    }

                    tdModif.onclick = function()
                    {
                        
                        document.getElementById("contenedor").className = "contenedorBloqueado";
                      
                        $("#enviarModif").attr("disabled", false);
                        document.getElementById("modalModif").className = "modalVisible";
                        cargarModif(valor.codArt);
                    }

                    tdBaja.onclick = function()
                    {
                        if(confirm("¿Está seguro de dar de baja el artículo?"))
                        {
                            baja(valor.codArt);
                        }
                    }      

                    $("#tabla").append(objTr);
                });

            
                $("#totalRegistros").html("Nro de registros: " + objJson.articulos.length);
            }
        });
    }

    $(document).ready(function(){

        cargarDesplegable();

        $("#formModalAlta").keyup(function()
            {
                habilitarAlta();
            }
        );

        $("#formModalModif").keyup(function()
            {
                habilitarModif();
            }
        );

        $("#vaciarFiltros").click(function()
        {
            $("#filtroCodArt").val("");
            $("#filtroFamilia").val("");
            $("#filtroUm").val("");
            $("#filtroDescripcion").val("");
            $("#filtroSaldoStock").val("");
            $("#filtroFechaAlta").val("");
            $("#orden").val("codArt");
        });

        $("#thCodArt").click(function(){
            $("#orden").val("codArt");
        });

        $("#thFamilia").click(function(){
            $("#orden").val("familia");
        });

        $("#thUm").click(function(){
            $("#orden").val("um");
        });

        $("#thDescripcion").click(function(){
            $("#orden").val("descripcion");
        });

        $("#thSaldoStock").click(function(){
            $("#orden").val("saldoStock");
        });

        $("#thFechaAlta").click(function(){
            $("#orden").val("fechaAlta");
        });

        $("#salirModif").click(function(){
            document.getElementById("modalModif").className = "modalInvisible";
            document.getElementById("contenedor").className = "contenedorDesbloqueado";
            vaciarCampos();
        });

        $("#salirAlta").click(function(){
            document.getElementById("modalAlta").className = "modalInvisible";
            document.getElementById("contenedor").className = "contenedorDesbloqueado";
            vaciarCampos();
        });

        $("#salirRespuesta").click(function()
        {
            document.getElementById("modalModif").className = "modalInvisible";
            document.getElementById("modalAlta").className = "modalInvisible";
            document.getElementById("modalRespuesta").className = "modalInvisible";
            document.getElementById("contenedor").className = "contenedorDesbloqueado";
        });

        $("#enviarAlta").click(function()
        {
            if(confirm("¿Está seguro de dar de alta el artículo?"))
            {
                alta();
            }
        });

        $("#enviarModif").click(function()
        {
            if(confirm("¿Está seguro de modificar el artículo?"))
            {
                modificar();
            }
        });

        $("#cargar").click(function(){
            $("#tabla").empty();
            $("#tabla").html("<h3>Cargando datos...</h3>");
            cargaDatos();
        });

        $("#vaciar").click(function(){
            $("#tabla").empty();
        })

        $("#alta").click(function(){
            document.getElementById("contenedor").className = "contenedorBloqueado";
            document.getElementById("modalAlta").className = "modalVisible";
            if($("#codArtAlta").val() == "" || $("#fechaAlta_Alta").val() == "" || $("#umAlta").val() == "" || $("#descripcionAlta").val() == "" || $("#saldoStockAlta").val())
            {
                $("#enviarAlta").attr("disabled", true);
            }
        });

        $("#cerrarSesion").click(function() {
            if(confirm("¿Está seguro de cerrar sesión?")){
                location.href="../destruirSesion.php";
            }
        });

    });
</script>
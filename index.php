<?php

    require_once __DIR__ . '/src/utilidades.php';
    require_once __DIR__ . '/src/LecturaXML.php';
    require_once __DIR__ . '/src/ValidaCFDI.php';

    function validarFactua($cfdi = null)
    {
        try {

            $lecturaXML = new LecturaXML($cfdi);

            if ($lecturaXML->cargado() === true) {
                $validaCFDI = new ValidaCFDI;
                $respuestas = $validaCFDI->validar($lecturaXML);
            } else {
                throw new Exception("El archivo proporcionado no pudo ser cargado. Asegurese que proporciona un archivo XML.");
            }

        } catch (Exception $e) {
            $respuestas = $e->getMessage();
        }

        return $respuestas;
    }

    if (validarArchivoEntrante('fact', 'text/xml') === true) {
        extract($_FILES['fact']);
        $validacion = validarFactua($tmp_name);
        debug($validacion);
    }
?>

<!DOCTYPE html>
<html lang="es_ES" class="no-js">

    <head>
        <title>Validador de CFDi</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Un pequeño script en PHP que permite conectarte al WS del SAT para validar el estatus de un CFDI's.">
        <!--<link href="images/favicon.png" rel="shortcut icon">
        <link href="styles/general.css" rel="stylesheet">
        <script src="js/script.js"></script>-->
    </head>

    <body>

        <form action="./index.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <label>Seleccióne XML factura: </label>
            <input type="file" name="fact" value=""/>
            <br/>
            <input type="submit" value="Validar"/>
        </form>

    </body>

</html>

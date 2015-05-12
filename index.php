<?php

require_once __DIR__ . '/src/utilidades.php';
require_once __DIR__ . '/src/LecturaXML.php';
require_once __DIR__ . '/src/ValidaCFDI.php';

try {

    $lecturaXML = new LecturaXML(__DIR__ . '/../facturas/45.xml');

    if ($lecturaXML->cargado() === true) {
        $validaCFDI = new ValidaCFDI;
        $respuestas = $validaCFDI->validar($lecturaXML);
    } else {
        throw new Exception("El archivo proporcionado no pudo ser cargado. Asegurese que proporciona un archivo XML.");
    }

} catch (Exception $e) {
    $respuestas = $e->getMessage();
}

debug($respuestas);exit;

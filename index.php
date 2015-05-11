<?php

require_once __DIR__ . '/src/utilidades.php';
require_once __DIR__ . '/src/LecturaXML.php';
require_once __DIR__ . '/src/ValidaCFDI.php';

try {

    $lecturaXML = new LecturaXML(__DIR__ . '/../facturas/45.xml');
    $datos = $lecturaXML->leer();

    $validaCFDI = new ValidaCFDI;
    $respuestas = $validaCFDI->validar($datos);

} catch (Exception $e) {
    $respuestas = $e->getMessage();
}

debug($respuestas);

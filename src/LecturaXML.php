<?php

class LecturaXML {


    /**
     * Objeto de la clase DOMDocument.
     *
     * @var DOMDocument Object
     */
    protected $domd;


    /**
     * constructor de la clase.
     *
     * @access public
     * @param  string  $xml  (la ruta del archivo XML)
     */
    public function __construct($xml = null)
    {
        $this->domd = new DOMDocument('1.0', 'utf-8');
        $this->domd->load($xml);

    }


    /**
     * Ejecuta la extracción de los datos necesarios para validar un CFDi.
     *
     * @access public
     * @return array
     */
    public function leer()
    {
        return $this->extraerDatos();
    }


    /**
     * Permite extraer los datos necesarios para la validación de una
     * factura usando el WS del SAT.
     *
     * @access private
     * @return array
     */
    private function extraerDatos()
    {
        // extraer UUID:
        $tfd = $this->domd->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', 'TimbreFiscalDigital');
        $tfd = $tfd->item(0);

        // extraer RFC emisor:
        $rfc_emisor = $this->domd->getElementsByTagName('Emisor');
        $rfc_emisor = $rfc_emisor->item(0);

        // extraer RFC receptor:
        $rfc_receptor = $this->domd->getElementsByTagName('Receptor');
        $rfc_receptor = $rfc_receptor->item(0);

        // extraer TOTAL de factura:
        $total = $this->domd->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3','Comprobante');
        $total = $total->item(0);

        return array(
            're' => $rfc_emisor->getAttribute('rfc'),
            'rr' => $rfc_receptor->getAttribute('rfc'),
            'tt' => $total->getAttribute('total'),
            'id' => $tfd->getAttribute('UUID'),
        );
    }


    // end class.
}

// end of file: LecturaXML.php

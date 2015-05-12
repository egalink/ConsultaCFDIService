<?php

require_once __DIR__ . '/ClienteSOAP.php';

class ValidaCFDI {


    /**
     * URL del webservice ó wsdl del servicio:
     *
     * @var string
     */
    protected $wsdl = "https://consultaqr.facturaelectronica.sat.gob.mx/ConsultaCFDIService.svc?wsdl";


    /**
     * Objeto del cliente SOAP.
     *
     * @var ClienteSOAP Object.
     */
    protected $clienteSOAP;


    /**
     * Cadena que será enviada como parámetro al WS.
     *
     * @var string
     */
    protected $factura = '?';


    /**
     * Almacena los datos del comprobante (CFDi) a validar:
     *
     * Se necesitan:
     *
     * emisor_rfc
     * receptor_rfc
     * total
     * uuid
     *
     * @var array
     */
    protected $CFDi = array(
        're' => null,
        'rr' => null,
        'tt' => null,
        'id' => null,
    );


    /**
     * constructor de la clase.
     *
     * @access public
     */
    public function __construct()
    {
        $this->clienteSOAP = new ClienteSOAP($this->wsdl, ['encoding' => 'utf-8']);
    }


    /**
     * Arranca el cliente SOAP para validar un CFDI con el WS del SAT.
     *
     * @access public
     * @param  LecturaXML  $lecturaXML
     * @return array
     */
    public function validar(LecturaXML $lecturaXML)
    {
        $datos = $lecturaXML->call(function($xml) {

            // extraer UUID:
            $tfd = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', 'TimbreFiscalDigital');
            $tfd = $tfd->item(0);

            // extraer RFC emisor:
            $rfc_emisor = $xml->getElementsByTagName('Emisor');
            $rfc_emisor = $rfc_emisor->item(0);

            // extraer RFC receptor:
            $rfc_receptor = $xml->getElementsByTagName('Receptor');
            $rfc_receptor = $rfc_receptor->item(0);

            // extraer TOTAL de factura:
            $total = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3','Comprobante');
            $total = $total->item(0);

            return array(
                're' => $rfc_emisor->getAttribute('rfc'),
                'rr' => $rfc_receptor->getAttribute('rfc'),
                'tt' => $total->getAttribute('total'),
                'id' => $tfd->getAttribute('UUID'),
            );

            // end callback.
        });

        $this->CFDi = $datos;
        return $this->consultaCFDi($this->parametrosWS());
    }


    /**
     * Genera una cadena con los parametros que serán enviados al WS.
     *
     * @access private
     * @return string
     */
    private function parametrosWS()
    {
        $this->factura .= http_build_query($this->CFDi, '', '&');
        return $this->factura;
    }


    /**
     * Realiza una consulta al WS.
     *
     * @access private
     * @return stdClass Object
     */
    private function consultaCFDi()
    {
        $consulta = $this->clienteSOAP->Consulta(["expresionImpresa" => $this->factura]);
        return $consulta->ConsultaResult;
    }


    // end class.
}

// end of file: ValidaCDFI.php

<?php

class ClienteSOAP extends SoapClient {


    /**
     * Configura el cliente SOAP.
     *
     * @access public
     * @param  string  $wsdl (URL del webservice ó wsdl del servicio)
     * @param  array   $opciones (Parametros de configuración del Ws)
     */
    public function __construct($wsdl = null, $opciones = array())
    {
        parent::__construct($wsdl, $opciones);
    }


    /**
     * Llama a una función SOAP.
     *
     * @access public
     * @param  string  $function
     * @param  array   $arguments
     * @param  array   $options
     */
    public function call($function, array $arguments = array(), array $options = array())
    {
        return $this->__soapCall($function, $arguments, $options);
    }


    // end class.
}

// end of file: ClienteSOAP.php

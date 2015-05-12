<?php

class LecturaXML extends DOMDocument {


    /**
     * Identifica que el archivo XML fue cargado exitosamente.
     *
     * @var bool
     */
    protected $carga = false;


    /**
     * Constructor de la clase.
     *
     * @access public
     * @param  string  $xml  (la ruta del archivo XML)
     */
    public function __construct($xml = null)
    {
        parent::__construct('1.0', 'utf-8');

        if ($this->load($xml) === true) {
            $this->carga = true;
        }
    }


    /**
     * Determina si el archivo XML fue cargado exitosamente.
     *
     * @access public
     * @return bool
     */
    public function cargado()
    {
        return $this->carga;
    }


    /**
     * Ejecuta una funcion dada como parametro y recibe como argumento
     * el objeto de esta clase.
     *
     * @access public
     * @param  callback  $callback
     * @return mixed
     */
    public function call($callback)
    {
        return call_user_func($callback, $this);
    }


    // end class.
}

// end of file: LecturaXML.php

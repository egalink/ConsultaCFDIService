<?php

if (! function_exists('debug')) {

    /**
     * Imprime información legible para humanos sobre una variable
     *
     * @param  mixed
     */
    function debug()
    {
        $trace = debug_backtrace();
        echo '<pre style="font-family:monospace;font-size:11px;">File: ';
        echo $trace[0]['file'].' - '.$trace[0]['line'];
        echo '</pre>';

        foreach(func_get_args() as $variable) {
            echo '<pre style="font-family:monospace;font-size:11px;">';
            print_r($variable);
            echo '</pre>';
        }
    }
}

if (! function_exists('vdump')) {

    /**
     * Muestra información estructurada sobre una o más expresiones
     * incluyendo su tipo y valor.
     *
     * @param  mixed
     */
    function vdump()
    {
        $trace = debug_backtrace();
        echo '<pre style="font-family:monospace;font-size:11px;">File: ';
        echo $trace[0]['file'].' - '.$trace[0]['line'];
        echo '</pre>';

        foreach(func_get_args() as $variable) {
            echo '<pre style="font-family:monospace;font-size:11px;">';
            echo var_dump($variable);
            echo '</pre>';
        }
    }
}

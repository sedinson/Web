<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Content
 * Clase encargada de mostrar contenido cargado luego de que una vista cargara una plantilla.
 * En algun lugar en las plantillas usadas, se hace la llamada al metodo principal de esta clase
 * que es el metodo display. Basicamente cargara el contenido enviado por la pagina.
 *
 * @author sedinson
 */
    class Content 
    {
        protected $path;
        protected $vars;
        protected $config;
        
        function __construct($path, $vars = array()) 
        {
            $this->config = Config::singleton();
            $this->path = $path;
            $this->vars = $vars;
        }
        
        function display()
        {
            $vars = $this->vars;
            if(file_exists($this->path))
                include $this->path;
            else
                trigger_error ('View `' . $path . '` does not exist.', E_USER_NOTICE);
        }
    }

?>

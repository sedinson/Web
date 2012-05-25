<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 * Esta clase será la encargada de controlar las plantillas y el contenido a cargar.
 *
 * @author sedinson
 */
    class View
    {
        protected $content;
        
	public function show($name, $vars = array(), $obj = null)
	{
            //$name es el nombre de nuestra plantilla, por ej, listado.php
            //$vars es el contenedor de nuestras variables, es un arreglo del tipo llave => valor, opcional.

            //Traemos una instancia de nuestra clase de configuracion.
            $config = Config::singleton();

            //Armamos la ruta a la plantilla
            $path = $config->get('layoutsFolder') . $config->get('layout') . '.php';

            //Si no existe el fichero en cuestion, tiramos un 404
            if (file_exists($path) == false)
            {
                    trigger_error ('Template `' . $path . '` does not exist.', E_USER_NOTICE);
                    return false;
            }

            $this->content = new Content($config->get('viewsFolder') . $name, $vars);

            //Finalmente, incluimos la plantilla.
            include($path);
	}
        
        public function partial($name, $vars = array(), $obj = null)
        {
            $config = Config::singleton();
 
            //Armamos la ruta a la plantilla
            $path = $config->get('viewsFolder') . $name;

            //Si no existe el fichero en cuestion, tiramos un 404
            if (file_exists($path) == false)
            {
                    trigger_error ('Template `' . $path . '` does not exist.', E_USER_NOTICE);
                    return false;
            }

            $this->content = null;

            //Finalmente, incluimos la plantilla.
            include($path);
        }
    }
?>
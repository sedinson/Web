<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerBase
 * De esta clase heredaran todos los modelos sus metodos y su constructor. La idea es que esta clase
 * contenga metodos importantes que no es necesario reescribir para todos los controladores, tales como
 * obtener un modelo, tener las variables principales...
 *
 * @author sedinson
 */
    abstract class ControllerBase {

        protected $post;
        protected $get;
        protected $view;
        protected $config;
        protected $files;

        function __construct($post, $get, $files)
        {
            $this->config = Config::singleton();
            @$this->get = split("/", $get);
            $this->post = $post;
            $this->files = $files;
            $this->view = new View();
        }
        
        function getModel($model)
        {
            $modelName = $model . 'Model';
            $modelPath = $this->config->get('modelsFolder') . $modelName . '.php';
            if(is_file($modelPath)) 
                require $modelPath;
            else
                die ("No se pudo encontrar " . $modelName);
            
            $model = new $modelName();
            return $model;
        }
    }
?>
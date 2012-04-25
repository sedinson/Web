<?php
    abstract class ControllerBase {

        protected $post;
        protected $get;
        protected $view;
        protected $config;
        protected $files;

        function __construct($post, $get, $files)
        {
            $this->config = Config::singleton();
            $this->get = str_getcsv($get, '/');
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
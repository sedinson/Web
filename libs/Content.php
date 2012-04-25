<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Content
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

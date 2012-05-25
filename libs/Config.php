<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author sedinson
 */
    class Config
    {
        private $vars;
        private static $instance;

        private function __construct()
        {
            $this->vars = array();
        }

        public function set($name, $value)
        {
            if(!isset($this->vars[$name]))
            {
                $this->vars[$name] = $value;
            }
        }

        public function get($name)
        {
            if(isset($this->vars[$name]))
            {
                return $this->vars[$name];
            }
        }

        public static function singleton()
        {
            if (!isset(self::$instance)) {
                $c = __CLASS__;
                self::$instance = new $c;
            }

            return self::$instance;
        }
    }
?>

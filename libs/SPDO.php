<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SPDO
 * Extiende de la clase PDO (PHP Data Object), y su funcion es hacer que exita una sola instancia
 * de la base de datos y tambien de conectarse a la BD.
 *
 * @author sedinson
 */
    class SPDO extends PDO {
        
        private static $instance = null;
        
        public function __construct() 
        {
            $config = Config::singleton();
            parent::__construct('mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname'), $config->get('dbuser'), $config->get('dbpass'));
        }
        
        public static function singleton()
	{
		if( self::$instance == null )
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
    }
?>

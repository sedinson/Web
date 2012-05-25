<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelBase
 * De esta clase, los modelos heredaran el constructor, que es el encargado de conectarse a la base de datos
 * y velar por los datos.
 *
 * @author sedinson
 */
    abstract class ModelBase
    {
            protected $db;

            public function __construct()
            {
                    $this->db = SPDO::singleton();
            }
            
            public function query ($strQuery, $values) {
                //Aquí se evaluarán las variables y generará la consulta
            }
            
            public function execute ($strQuery, $values) {
                //Aquí se evaluarán las variables y generará la consulta
            }
    }
?>
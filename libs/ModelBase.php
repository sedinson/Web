<?php
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
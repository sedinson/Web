<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PruebaController
 *
 * @author Edinson Salas
 */
class PruebaController extends ControllerBase {
    
    function uno() {
        for($i=0; $i<100; $i++) {
            echo "<h1 onclick=\"alert('Hello World...!')\">Hola Mundo...!</h1>";
        }
    }
}

?>

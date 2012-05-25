<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of congigs
 * Aqui se agregan todas las configuraciones de la aplicacion
 * OJO: En este archivo esta contenida la informacion para conectar al servidor y la de localhost.
 *      Este archivo preferiblemente no se remplaza en el servidor.
 *
 * @author sedinson
 */
    $config = Config::singleton();
    
    #Configuracion de la Base de Datos
    $config->set('dbhost', 'localhost');
    $config->set('dbname', 'stat');
    $config->set('dbuser', 'root');
    $config->set('dbpass', '');
//    $config->set('dbhost', 'mysql11.000webhost.com');
//    $config->set('dbname', 'a5036524_stat');
//    $config->set('dbuser', 'a5036524_admin');
//    $config->set('dbpass', 'q6td99');
    
    #Configuracion de Carpetas del Proyecto
    $config->set('controllersFolder', 'Controllers/');
    $config->set('modelsFolder', 'Models/');
    $config->set('viewsFolder', 'Views/');
    $config->set('layoutsFolder', 'Layouts/');
    
    #Configuracion de Layout
    $config->set('layout', 'default');
    
    #Configuracion de Conexiones
    $config->set('BaseUrl', 'http://localhost/web');
    $config->set('InitUrl', 'http://localhost/web/index.php');
//    $config->set('BaseUrl', 'http://statistics.hostzi.com');
//    $config->set('InitUrl', 'http://statistics.hostzi.com/index.php');
    
    #Configuracion del usuario
    $config->set('password', 'sistemas2012');
?>

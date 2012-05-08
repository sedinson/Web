<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    $config = Config::singleton();
    
    #Configuracion de la Base de Datos
//    $config->set('dbhost', 'localhost');
//    $config->set('dbname', 'stat');
//    $config->set('dbuser', 'root');
//    $config->set('dbpass', '');
    
    $config->set('dbhost', 'mysql11.000webhost.com');
    $config->set('dbname', 'a5036524_stat');
    $config->set('dbuser', 'a5036524_admin');
    $config->set('dbpass', 'q6td9.9fmq3');
    
    #Configuracion de Carpetas del Proyecto
    $config->set('controllersFolder', 'Controllers/');
    $config->set('modelsFolder', 'Models/');
    $config->set('viewsFolder', 'Views/');
    $config->set('layoutsFolder', 'Layouts/');
    
    #Configuracion de Layout
    $config->set('layout', 'default');
    
    #Configuracion de Conexiones
//    $config->set('BaseUrl', 'http://localhost/web');
    $config->set('BaseUrl', 'http://statistics.hostzi.com');
    $config->set('BaseFtp', 'ftp://localhost/web');
    
    #Configuracion del usuario
    $config->set('password', '1234');
?>

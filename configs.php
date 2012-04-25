<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    $config = Config::singleton();
    
    #Configuracion de la Base de Datos
    $config->set('dbhost', 'localhost');
    $config->set('dbname', 'stat');
    $config->set('dbuser', 'root');
    $config->set('dbpass', '');
    
    #Configuracion de Carpetas del Proyecto
    $config->set('controllersFolder', 'Controllers/');
    $config->set('modelsFolder', 'Models/');
    $config->set('viewsFolder', 'Views/');
    $config->set('layoutsFolder', 'Layouts/');
    
    #Configuracion de Layout
    $config->set('layout', 'default');
    
    #Configuracion de Conexiones
    $config->set('BaseUrl', 'http://localhost/web');
    $config->set('BaseFtp', 'ftp://localhost/web');
    
    #Configuracion del usuario
    $config->set('password', '1234');
?>

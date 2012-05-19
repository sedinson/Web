<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    class StartController {
        
        public static function main () 
        {
            require 'libs/Config.php';
            require 'libs/SPDO.php';
            require 'libs/ControllerBase.php';
            require 'libs/ModelBase.php';
            require 'libs/Content.php';
            require 'libs/View.php';
            
            require 'configs.php';
            
            $config = Config::singleton();
            
            if(! empty($_GET['controller']))
		      $controllerName = $_GET['controller'] . 'Controller';
			else
				  $controllerName = "IndexController";
	 
			if(! empty($_GET['action']))
				  $actionName = $_GET['action'];
			else
			  $actionName = "index";
				
			if(! empty ($_GET['str']))
				$str = $_GET['str'];
			else
				$str = null;
 
			$controllerPath = $config->get('controllersFolder') . $controllerName . '.php';
	 
			if(is_file($controllerPath))
				  require $controllerPath;
			else 
			{
				$controllerName = 'ErrorController';
				$controllerPath = $config->get('controllersFolder') . $controllerName . '.php';
				$actionName = "index";
				
				if(is_file($controllerPath))
					require $controllerPath;
				else
					die("El controlador ´$controllerName´ no existe - 404 not found");
			}
					
			if (is_callable(array($controllerName, $actionName)) == false)
			{
				trigger_error ($controllerName . '->' . $actionName . '` no existe', E_USER_NOTICE);
				return false;
			}
			
			$controller = new $controllerName($_POST, $str, $_FILES);
			$controller->$actionName();
        }
    }
?>

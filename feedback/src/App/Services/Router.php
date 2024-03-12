<?php

namespace App\Services;


use App\Services\Tokenize;

use Exception;

class Router {
    
    public static $controllerPrefix = '';
    public static $modelPrefix = 'Model';
    public static $viewPrefix = 'View';
    // public static $actionPrefix = 'Action';

    public static $modelFolder = "./src/App/Model";
    public static $controllerFolder = "./src/App/Controller";


    static function start()
		{
			$controllerName = "main";
			$actionName = "index";

			$routes = explode("/", $_SERVER['REQUEST_URI']);

            if(!empty($routes[1])) $controllerName = $routes[1].Router::$controllerPrefix;
			if(!empty($routes[2])) $actionName = $routes[2];

			$controllerFileName = ucfirst($controllerName).".php";
			$controllerPath = Router::$controllerFolder.'/'.$controllerFileName;

			if(file_exists($controllerPath)) require_once $controllerPath;
			else throw new Exception("The Controller (".$controllerPath.") file is not found.");

			// Init the controller
			$modifyControllerName = "App\Controller\\".ucfirst($controllerName);

			$controller = new $modifyControllerName;
			$action = $actionName;

			if(method_exists($controller, $action))
			{
				$controller->$action();
			}

			else throw new Exception("Action ".$action." from Controller is not found.");
		}

	static function APIStart($controller, $params, $permissions=true) 
	{
		$headers = apache_request_headers();
		$userID = 0;
		if($permissions == true)
		{
			$authorizationData = $headers['Authorization'];
			$token = explode(" ", $authorizationData);
			if($token[0] != "Token") throw new Exception("Token is invalid.");

			$userID = Tokenize::authorization($token[1]);
		}

		$controllerObject = new $controller;
		$action = $params[0];

		if(is_string($params[0]))
		{
			$dataBody = file_get_contents("php://input");
			$dataBodyJSON = json_decode($dataBody);
			$controllerObject->$action($headers, $dataBodyJSON, $userID);
		}

		

	}


}
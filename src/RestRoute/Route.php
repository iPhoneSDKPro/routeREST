<?php
/**
 * 
 */
namespace RestRoute;

class Route{

	public static function routeREST($controllerNameSpace){

		$uriParamSplit = explode('?', strtolower(substr($_SERVER['REQUEST_URI'], 1)));
		$uri = explode('/', $uriParamSplit[0]);
		array_splice($uri, 0, 1);
		
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		$requestVars['GET'] = $_GET;
		$requestVars['POST'] = $_POST;
		$requestVars['HEADER'] = apache_request_headers();

		$URI_0 = ucfirst($uri[0]);


		
		$json = utf8_encode(file_get_contents('php://input'));
		$con = $controllerNameSpace . $URI_0 . 'Controller';

        $methodIndex = 1;
		if (class_exists($con)){
			$controller = new $con();
			$pathTestBase = $method;
			//Find the Longest matching Path function for the request
			$callMethod = "";
			for($i = 1;$i< count($uri);$i++){
				$pathTestBase = $pathTestBase . "_" . ucfirst($uri[$i]);
				if (method_exists($controller,$pathTestBase)){
					$callMethod = $pathTestBase;
					$methodIndex = $i;
				}
			}

			if ($callMethod != ""){
				if ($methodIndex + 1 < count($uri)){
					$updatedUei = array_slice($uri,$methodIndex + 1);
					unset($uri);
					$uri[] = $URI_0;
					$uri = array_merge($uri,$updatedUei);
				}
			}

			//If long Path is found make that the $method to be called
			if ($callMethod != "") $method = $callMethod;

			if (method_exists($controller,$method)){
				if (method_exists($controller,"validateInputs")){
					
					if (!$controller->validateInputs($method,$uri,$requestVars,$json)){
						RESTResponse::ResponseStatus(401, "Malformed Request", null);
						die();
					}
				}
				if (array_key_exists("Authorization", $requestVars['HEADER'])){
					if (!$controller::Authorize($method, $uri,$requestVars,$json)){
						$statusMessage = "Authorization Failed";
						return RESTResponse::ResponseStatus(401, $statusMessage,null);
					}
				}
				return $controller->$method($uri,$requestVars,$json);
			}else{
				$statusMessage = 'Unsupported Verb ' . strtoupper($method) .  ' for Path /' . $URI_0 .  ' : Not Found';
				return RESTResponse::ResponseStatus(405, $statusMessage,null);
			}
		}else {
			$statusMessage = 'URL Path /' . $URI_0 .  ' Not Found';
			return RESTResponse::ResponseStatus(404, $statusMessage,null);
		}
	}
}
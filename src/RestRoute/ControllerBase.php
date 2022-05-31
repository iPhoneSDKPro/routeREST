<?php
namespace RestRoute;
use RestRoute\RESTResponse;

class ControllerBase{
	public static function Authorize($method, $uri,$requestVars,$json){
		return false;
	}
	public static function validateInputs($uriPathArray, $requestVars,$json){
		return true;
	}
	public static function get($uriPathArray, $requestVars,$json){
		return RESTResponse::ResponseStatus(405, "GET: Function not defined for this controller",null);
	}
	public static function post($uriPathArray, $requestVars,$json){
		return RESTResponse::ResponseStatus(405, "POST: Function not defined for this controller",null);
	}
}
<?php
namespace RestRoute;
class RESTResponse{
	public static function OK($response){
		header("HTTP/1.1 200 OK");
		echo $response;
		die();
	}
	public static function ResponseStatus($statusCode, $statusMessage, $response){
		$status = 'HTTP/1.1 ' . $statusCode . ' ' . $statusMessage;
		header($status);
		if ($response){
			echo $response;
			die();
		}else{
			
			return $statusMessage;
		}
		
	}
}
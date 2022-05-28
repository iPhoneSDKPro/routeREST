<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

 require_once 'vendor/autoload.php';

 $uriParamSplit = explode('?', strtolower(substr($_SERVER['REQUEST_URI'], 1)));

 
 $uri = explode('/', $uriParamSplit[0]);
 
 $URI_0 = ucfirst($uri[0]);
 
 switch ($URI_0){
 	case "Api":
		echo RestRoute\Route::routeREST("SampleNameSpace\\Controller\\");
 		break;
 	default:
 		include "PageControllers/$URI_0/index.php";
 }
 
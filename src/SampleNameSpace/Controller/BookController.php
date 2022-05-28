<?php
namespace SampleNameSpace\Controller;
use RestRoute\ControllerBase;
use RestRoute\RESTResponse;

/**
 * This is a simple sample class
 * 
 * The method names must match the the call method. This can be any of the HTTP methods, "GET", POST, PATCH, DELETE, etc, but with lowercase names to better match convention
 * $uriPathArray
 *      This is an array of the elements of the URI
 *         http://hosturi/Api/Customer/List
 *         $uriPathArrat[0] = "Customer"
 *         $uripathArray[1] = "List"
 * $requestVariables
 * 		$requestVars['GET'] = $_GET;
 *		$requestVars['POST'] = $_POST;
 *		$requestVars['HEADER'] = apache_request_headers();
 * $json
 *      This is the Body data sent in the call
 * 
 */
class BookController  extends ControllerBase{

    public static function post($uriPathArray, $requestVars,$json){
       // echo "GET:Book" . chr(13);
       // echo implode(chr(13),$uriPathArray) . chr(13);;
      //  var_dump($requestVars);

       return RESTResponse::OK($json);
    }
    public static function get_List($uriPathArray, $requestVars,$json){
        echo "GET:Book/Chapter" . chr(13);
        echo "URI Array" . chr(13);
        echo implode(chr(13),$uriPathArray) . chr(13);;
        var_dump($requestVars);
    }
}
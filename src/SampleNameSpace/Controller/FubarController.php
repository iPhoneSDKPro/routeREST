<?php
namespace SampleNameSpace\Controller;
use RestRoute\ControllerBase;

/**
 * This is a simple sample class
 * 
 * The method names must match the the call method. This can be any of the HTTP methods, "GET", POST, PATCH, DELETE, etc, but with lowercase names to better match convention
 * $uriPathArray
 *      This is an array of the elements of the URI
 *         http://hosturi/Api/Customer/List
 *         $uriArrai[0] = "Customer"
 *         $uriArrau[1] = "List"
 * $requestVariables
 * 		$requestVars['GET'] = $_GET;
 *		$requestVars['POST'] = $_POST;
 *		$requestVars['HEADER'] = apache_request_headers();
 * $json
 *      This is the Body data sent in the call
 * 
 */
class FubarController  extends ControllerBase{

    public static function get($uriPathArray, $requestVars,$json){
        echo "GET:Fubar";
    }
    public static function get_Book_Chapter($uriPathArray, $requestVars,$json){
        echo $uriPathArray[1];
    }
}
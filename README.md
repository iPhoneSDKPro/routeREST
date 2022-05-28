This package is designed to provide a simple routing component for PHP REST API development.

Routning is automatic. There are not route definitions to create or keep track of. Specificly
designed to complie to strict REST API standards including the proper use of StatusCodes and
URI structure.

Automatic PATH routing is accomplished by using a simple pattern for developing controllers.
For each unique name in what is considered the FIRST api uri parh element you will create a
controller. There is a strict naming convention.

Naming Convention:

In the example below, 'Books' is the first significant element of the api call

http://restserver.xxx/api/Books/

http://restserver.xxx/api/{CLASS_PATH_ELEMENT}/PARAM_1/PARAM_2}

The {CLASS_PATH_ELEMENT} translaates to the class file named BooksController.php


REST VERBS
REST API have very strict VERB/methods

- POST
- GET
- PUT
- DELETE
- PATCH

For each of the verb you plan on implementing in for the controller you will create a public function.

Basic Method Implementation
=====

Api Call
http://restserver.xxx/api/Book/

	namespace SampleNameSpace\Controller
	class BookController{
	       public static function validateInputs($methodCall,$uriArray, $requestVars,$json){
	       	   //Read below "Input Validation"
	       }
		public static function get(($uriArray, $requestVars, $json)){
			return $jsondata;
		}
		public static function post(($uriArray, $requestVars, $json)){
			return $jsondata;
		}
		public static function delete(($uriArray, $requestVars, $json)){
			return $jsondata;
		}
		public static function patch(($uriArray, $requestVars, $json)){
			return $jsondata;
		}		
	}

Long Uri Method Route
=====

The Route function attemots to find the longest function name available in the class until the longest name is found.

Long Uri name routiung allows for more advanced method naming instead of using logic to determine functionality in the call below, using the advances long uri function naming convention.

Api Call
http://restserver.xxx/api/Book/Chapter/Title

info:The $uruArray[1] becomes the first uri element after the longest method name found
		
		public static function get_Chapter(($uriArray, $requestVars, $json)){
			return $jsondata;
                }
		public static function post_Chapter(($uriArray, $requestVars, $json)){
			return $jsondata;
                }
		
THe $uriArray would be array("Book", "Title");


The routeREST class instanciate your controller object and call the function that matches the VERB used to call the api.
Within that function you have access to;

URIElements Array
json - Body data from POST, PUT, PATCH
php RequestVariables
php HeaderData

Namespace Support:
You can place all your controller in a single namespace for use with routeREST by passing the namespace definition in the
constructor.

the total content of your index.php
	echo RestRoute\Route::routeREST("MyNamespace\\Controller\\");


Input Validation Function
=========================

RouteRest allows you to handle input validation as part of the definition of your Controller. This is an OPTIONAL function. If the function is not part of your ControllerClass the system will not fail.

	public static function validateInputs($methodCall,$uriArray, $requestVars,$json){
		switch ($methodCall){
			case "get":
				if (!isset($uriArray[1])) return false;
				if ($uriArray[1] == "") return false;
				return true;
			case "post":
				if(!@json_decode($json)){
					return true;
				}
				return true;
			default:
				return true;
		}
		
		return true;
	}

Implementing this method in your controller to handle input validations. The switch is on the HTTP Method type.

HTTP Status/Code Response
=========================
There is more to a proper coded REST solution than getting the data right. Returning the correct Response codes is more important than just returning a 404, or a 200

RestResponse
------------
RESTResponse provides a simple class allowinq the proper return of status code and message.

		$statusMessage = 'URL Path /' . $URI_0 .  ' Not Found';
		return RESTResponse::ResponseStatus(404, $statusMessage,null);
			

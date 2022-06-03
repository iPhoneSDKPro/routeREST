routeREST v.90
=====

This package is designed to provide a simple routing component for PHP REST API development.

Routning is automatic. There are not route definitions to create or keep track of. Specificly
designed to complie to strict REST API standards including the proper use of StatusCodes and
URI structure.

Automatic PATH routing is accomplished by using a simple pattern for developing controllers.
For each unique name in what is considered the FIRST api uri parh element you will create a
controller. There is a strict naming convention.

Composer is required.
-----
https://getcomposer.org/

I use Composer to autoload the "psr-4" namespaces for project namespaces. See the included compose.json file for the example for the autoload section for the examples in the repository.

At some point I will make this a composer library.


Naming Convention:

In the example below, 'Book' is the first significant element of the api call

http://restserver.xxx/api/Book/

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
	class BookController extends ControllerBase{
	       public static function validateInputs($methodCall,$uriPathArray, $requestVars,$json){
	       	   //Read below "Input Validation"
	       }
		public static function get(($uriPathArray, $requestVars, $json)){
			return RESTResponse::OK($jsondata);
			
		}
		public static function post(($uriPathArray, $requestVars, $json)){
			
			return RESTResponse::OK($jsondata);
		}
		public static function delete(($uriPathArray, $requestVars, $json)){
			return RESTResponse::OK($jsondata);
		}
		public static function patch(($uriPathArray, $requestVars, $json)){
			return RESTResponse::OK($jsondata);
		}		
	}

Long Uri Method Route
=====

The Route function attemots to find the longest function name available in the class until the longest name is found.

Long Uri name routiung allows for more advanced method naming instead of using logic to determine functionality in the call below, using the advances long uri function naming convention.

Api Call
http://restserver.xxx/api/Book/Chapter/Title

info:The $uriPathArray[1] becomes the first uri element after the longest method name found
		
		public static function get_Chapter(($uriPathArray, $requestVars, $json)){
			return RESTResponse::OK($jsondata);
                }
		public static function post_Chapter(($uriPathArray, $requestVars, $json)){
			return RESTResponse::OK($jsondata;)
                }
		
THe $uriPathArray would be array("Book", "Title");

RESTResponse
------------ 
The routeREST class instanciate your controller object and call the function that matches the VERB used to call the api.
Within that function you have access to;

RESTResponse::OK($json_data);
RESTResponse::ResponseStatus($statusCode, $statusMessage, $response)


Controller Method Signiture Variables
------------------
- **$uriPathArray**
- $requestVars
	- requestVars["POST"]
	- requestVars["GET"]
	- requestVars["HEADER"]
	
php RequestVariables
php HeaderData

Namespace Support:
You can place all your controller in a single namespace for use with routeREST by passing the namespace definition in the
constructor.

the total content of your index.php
	echo RestRoute\Route::routeREST("MyNamespace\\Controller\\");


Input Validation Function
------

RouteRest allows you to handle input validation as part of the definition of your Controller. This is an OPTIONAL function. The function is defined in the ControllerBase class. The base class retruns boolean true bay dault. You must override the method in your Controller Class

	public static function validateInputs($methodCall,$uriPathArray, $requestVars,$json){
		switch ($methodCall){
			case "get":
				if (!isset($uriPathArray[1])) return false;
				if ($uriPathArray[1] == "") return false;
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

ControllerBase Classs
=====


HTTP Status/Code Response
=========================
There is more to a proper coded REST solution than getting the data right. Returning the correct Response codes is more important than just returning a 404, or a 200

RestResponse
------------


Installation
=====
- Download the VirtualBox VM from my google drive:   
https://drive.google.com/file/d/1NDCVu-d2YEyLsB8ZP4WUdQP6GgyXRIbI/view?usp=sharing

This Virtual Server can be launched from VirtualBox. VirtualBox is FREE. Set the Network configuration in VirtualBox to bridged and you can access the routeREST instance installed in the root default web.

Install Composer Dependency Manager in the base url folder

- Apache Server Modifications   

	- Mod_ReWrite Enable  

	- Enable .htaccess  

	- Copy .htaccess to root folder of site  

- Copy index.php to root folder

- Copy the "src" folder from this project to your root folder

- Modify the composer.jason autolosd/psr-4 section to match the composer.json file in this project. Use the one in this project as a guide.
	- You need to add the section autoload/psr-4 entries as seen in this project
		
	
**Your project customization**  
- Create a new folder in the "src" folder for your project name
- Create a new folder in your project folder named "Controller"
	- This is where your Controller Classes will go
	- Naming is {EndPoint}COntroller.php (See **src/SampleNameSpace** folder for pattern
	- 


Examples and Tests:
=====
I have included the Poatman Collection that I used to verify the accuricy of the examples used for SampleNameSpace project in the repository.
The link will allow you  to view and execute the requests against your own server
RouteREST Postman Public Workspace - https://www.postman.com/captjames/workspace/routerest/overview

Explaination of Postman Collection Requests and how they are routed.
-Book List*Authorized*
----
{{server}}/API/Book/List


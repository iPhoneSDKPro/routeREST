This package is designed to provide a simple routing component for PHP REST API development.

Routning is automatic. There are not route definitions to create or keep track of. Specificly
designed to complie to strict REST API standards including the proper use of StatusCodes and
URI structure.

Automatic PATH routing is accomplished by using a simple pattern for developing controllers.
For each unique name in what is considered the FIRST api uri parh element you will create a
controller. There is a strict naming convention.

Naming Convention:

In the example below, 'Books' is the first significant element of the api call

http://restserver.xxx/api/vi/Books/

http://restserver.xxx/api/vi/{FIRST_PATH_ELEMENT}/

You must have a php class file named BooksController.php

REST VERBS
REST API have very strict VERB/methods

- POST
- GET
- PUT
- DELETE
- PATCH

For each of the verb you plan on implementing in for the controller you will create a public function.

Usage
=====

class BookController{
	public function GET(){
		return jsondate;
	}
	public function POST{

	}
	public function DELETE(){

	}
}
-----------------------
The routREST class instanciate your controller object and call the function that matches the VERB used to call the api.
Within that function you have access to;

URIElements Array
json - Body data from POST, PUT, PATCH
php RequestVariables
php HeaderData

Namespace Support:
You can place all your controller in a single namespace for use with routeREST by passing the namespace definition in the
constructor.

router = new RRouter(\\MyApp\\Controller);

In this example your controller are expected to all be in the:
namespace MyApp.Controler







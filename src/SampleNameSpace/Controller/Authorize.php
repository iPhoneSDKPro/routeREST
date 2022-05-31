<?php
namespace SampleNameSpace\Controller;
class Authorize{
    public static function AuthorizeUser($header){
        
        //This is a simple implementation of "Basic Auth" authorization
        //If you look at the PostMan collection you will see the request titled "Book List*Authorized*" that is configured to authorize
        // *Postman Collection
        //      https://www.postman.com/captjames/workspace/routerest/overview

        
       $base64 = $header["Authorization"];
        $authorization = explode(' ', $base64);

        if ($authorization[0] == "Basic"){
            $authBasic = base64_decode( $authorization[1]);

            $credentials = explode(':', $authBasic);
            
            if ("password" == $credentials[1] && "testuser" == ($credentials[0])){
                return true;
            }
        }

    }

}

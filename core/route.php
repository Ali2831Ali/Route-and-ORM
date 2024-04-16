<?php

class Route{


    function GetRoutes($url,$method)
    {
        switch ($method){
            case 'GET':
                return match($url){
                    //define get routes
                    'index'=>'user@index',
                    'index/index'=>'index@index',
                    'user/ali'=>'user@ali',
                    default => 'The route does not exist'
                };

            case 'POST':
                return match($url){
                    //define post routes
                    'index'=>'index@index',
                    'index/index'=>'index@index',
                    'index/ali'=>'index@ali',
                    default => 'The route does not exist'
                };
            case 'PUT':
                return match($url){
                    //define put routes
                    'index'=>'index@index',
                    'index/index'=>'index@index',
                    'index/ali'=>'index@ali',
                    default => 'The route does not exist'
                };
            case 'DELETE':
                return match($url){
                    //define delete routes
                    'index'=>'index@index',
                    'index/index'=>'index@index',
                    'index/ali'=>'index@ali',
                    default => 'The route does not exist'
                };
        }

    }

}

?>
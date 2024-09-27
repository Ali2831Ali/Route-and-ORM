<?php

class Route{



    function GetRoutes($url,$method,$attr)
    {
        switch ($method){
            case 'GET':

                    //define get routes
                    return match($url) {
                        'index' => 'user@index',
                        'avatar/index' => 'avatar@index',
                        'user/edit/' . $attr => 'user@edit',
                        'user/delete/' . $attr => 'user@delete',
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
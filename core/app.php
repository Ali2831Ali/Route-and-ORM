<?php


class App{

    public $controller='index';
    public $method='index';
    public $params=[];

    function __construct(){

        if(isset($_GET['url'])) {
            $url = $_GET['url'];
            $url=explode('/',$url);

            $urlR = $url[0];
            if (isset($url[1])) {
                $urlR = $url[0] . '/' . $url[1];
            }

            $route = new Route;
            $route = $route->GetRoutes($urlR,$_SERVER['REQUEST_METHOD']);
            if ($route == 'The route does not exist') echo 'The route is undefined';
            $route=explode('@',$route);


            $this->controller = $route[0];
            if (isset($route[1])) {
                $this->method = $route[1];
            }

        }


        unset($_GET['url']);
        $this->params=$_GET;

        $controllerUrl='controllers/'.$this->controller.'Controller.php';
        if(file_exists($controllerUrl)) {
            require $controllerUrl;
            $ControllerName = $this->controller.'Controller';
            $object=new $ControllerName;

            $object->model($this->controller);


            if (method_exists($object,$this->method)) {
                call_user_func_array([$object, $this->method], $this->params);
            }

        }


    }


}



?>
<?php

class Controller{



    function __construct(){

    }

    function view($viewUrl,$data=[], $noIncludeheader= '', $noIncludefooter= '')
    {
        if($noIncludeheader=='') {
            require('header.php');
        }

        require('views/' . $viewUrl . '.php');

        if($noIncludefooter=='') {
            require('footer.php');
        }
    }

    function model($modelname)
    {
        require ('models/'.$modelname.'.php');
        $this->model=new $modelname($modelname);
    }

}

?>
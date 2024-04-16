<?php

class userController extends Controller {
    function __construct(){
        parent::__construct();
    }

    function ali(){
        echo $this->model->user();
    }


}





?>
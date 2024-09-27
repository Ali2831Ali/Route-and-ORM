<?php

class userController extends Controller {
    function __construct(){
        parent::__construct();
    }

    function edit($attr){
        echo $this->model->edit($attr);
    }

    function delete($attr){
        echo $this->model->deleteuser($attr);
    }


}





?>
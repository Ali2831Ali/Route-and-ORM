<?php

class avatarController extends Controller {
    function __construct(){
        parent::__construct();
    }

    function index(){
        echo $this->model->addavatar();
    }



}
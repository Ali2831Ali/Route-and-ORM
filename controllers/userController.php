<?php

class userController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->model->where('id', 48);
        $this->model->Andwhere('ali', 2);
        $this->model->InsertInto();
        var_dump($this->model->finishQuery());
    }

    function edit($attr)
    {
        var_dump($this->model->Update(['name'], 'id', ['ali', $attr]));
    }

    function delete($attr)
    {
        var_dump($this->model->Delete('id', $attr));
    }


}


?>
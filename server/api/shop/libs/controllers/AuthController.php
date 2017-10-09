<?php
namespace controllers;


class AuthController extends \core\Controller
{

    protected $model;

    public function __construct ()
    {
        $this->model = new \models\UsersModel();
    }

    public function postAuth ()
    {
    	
    }

    

}

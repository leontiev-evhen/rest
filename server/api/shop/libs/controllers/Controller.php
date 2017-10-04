<?php
namespace controllers;
class Controller
{
    protected $model;
    public function __construct ()
    {
        $this->model = new \models\Model();
    }
}

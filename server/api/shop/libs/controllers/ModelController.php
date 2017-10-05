<?php
namespace controllers;

class ModelController extends \core\Controller
{
    protected $model;

    public function __construct ()
    {
        $this->model = new \models\ModelsModel();
    }

    public function getModel ()
    {
        $model = $this->model->getModelAuto();
        if ($model)
        {
            $result = ['status' => true, 'data' => $model, 'message' => 'getting model was success'];
        }
        else
        {
            $result = ['status' => false, 'message' => 'failed get model'];
        }

        return $result;
    }
}

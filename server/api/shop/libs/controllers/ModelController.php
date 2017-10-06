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

        $data = $this->model->getModelAuto();
        if ($data)
        {
            return $this->getServerAnswer(200, true, 'getting model was success', $data);
        }
        else
        {
            return $this->getServerAnswer(500, false, 'failed get model');
        }

        return $this->getServerAnswer(500, false, 'failed get model');
    }
}

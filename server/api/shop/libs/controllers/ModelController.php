<?php
namespace controllers;

class Model extends Controller
{

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

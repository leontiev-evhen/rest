<?php

class AutoController
{
    private $model;
    public function __construct ()
    {
        $this->model = new Model();
    }
    
    public function getAuto ()
    {
        $data = $this->model->getAuto();
        if ($data)
        {
            $result = ['success' => true, 'auto' => $data, 'message' => 'getting auto was success'];
        }
        else
        {
            $result = ['success' => false, 'message' => 'failed get auto'];
        }

        return $result;
    }
}

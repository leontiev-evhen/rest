<?php
namespace controllers;


class AutoController extends \core\Controller
{

    protected $model;

    public function __construct ()
    {
        $this->model = new \models\AutoModel();
    }

    public function getAuto ($params = false)
    {

        if (!empty($params)) 
        {
            $param = explode('/', $params);
            $id = $param[0];
            return $this->getAutoById($id);
        }
        else
        {
            $data = $this->model->getAuto();
            if ($data)
            {
                return $this->getServerAnswer(200, true, 'getting auto was success', $data);
            }
            else
            {
                return $this->getServerAnswer(500, false, 'failed get auto');
            }
        }

        return $this->getServerAnswer(500, false, 'failed get auto'); 
    }

   
    public function getAutoById ($id)
    {
        if (!empty($id)) 
        {
            $data = $this->model->getAutoById($id);
            if ($data)
            {
                return $this->getServerAnswer(200, true, 'getting auto was success', $data);
            }
            else
            {
                return $this->getServerAnswer(500, false, 'failed get auto');
            }
        }
        return $this->getServerAnswer(400, false, 'Bad Request'); 
    }
}

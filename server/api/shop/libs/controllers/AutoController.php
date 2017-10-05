<?php
namespace controllers;


class AutoController extends \core\Controller
{

    protected $model;

    public function __construct ()
    {
        $this->model = new \models\AutoModel();
    }

    public function getAuto ()
    {
        $data = $this->model->getAuto();
        if ($data)
        {
            $result = ['status' => true, 'data' => $data, 'message' => 'getting auto was success'];
        }
        else
        {
            $result = ['status' => false, 'message' => 'failed get auto'];
        }
        
        return $result;
    }

   
    public function getAutoById ($id)
    {
        
        if (!empty($id)) 
        {
            $data = $this->model->getAutoById($id);
            if ($data)
            {
                $result = ['status' => true, 'data' => $data, 'message' => 'getting auto was success'];
            }
            else
            {
                $result = ['status' => false, 'message' => 'failed get auto!'];
            }
            
            return $result;
        }
        throw new Exception("Server","parameter id is required"); 
    }

    
    public function postAuto ($data)
    {
        if (!empty($data))
        {
            $dataDecode = json_decode($data);
            $aData = $this->model->filterAuto($dataDecode);
            if ($aData)
            {
                $result = ['status' => true, 'data' => $aData, 'message' => 'filtering auto was success'];
            }
            else
            {
                $result = ['status' => false, 'message' => 'failed get auto'];
            }
            
            return $result;
        }
        throw new Exception("Server","parameter data is required");  
    }
}

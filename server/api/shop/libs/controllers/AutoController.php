<?php
namespace controllers;

class AutoController extends Controller
{

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
            $data = $this->model->getAutoInfo($id);
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
            
            return json_encode($result);
        }
        throw new SoapFault("Server","parameter data is required");  
    }
}

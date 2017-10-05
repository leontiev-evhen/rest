<?php
namespace controllers;

class OrderController extends \core\Controller
{
	protected $model;

    public function __construct ()
    {
        $this->model = new \models\OrderModel();
    }

  	public function postOrder ()
	{
		$json = file_get_contents('php://input');

		$data = json_decode($json);
		if (!empty($data)) 
		{
			$aData = $data;
			if ($this->model->preOrderAuto($aData))
			{
				$result = ['status' => true, 'message' => 'data received successfully'];
			}
			else
			{
				$result = ['status' => false, 'message' => 'error'];
			}
			
			return $result;
		}
		throw new Exception("Server","parameter data is required");  
	}
}
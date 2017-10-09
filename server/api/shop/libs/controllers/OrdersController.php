<?php
namespace controllers;
use \Exception;

class OrdersController extends \core\Controller
{
	protected $model;

	protected $rules = [
		'auto_id' 		=> 'integer',
		'user_id' 		=> 'integer',
		'payment_id'	=> 'integer',
		'status'		=> 'integer',
		'id'			=> 'integer'
	];


    public function __construct ()
    {
        $this->model = new \models\OrdersModel();
    }

    public function getOrders ()
    {
    	return $this->getServerAnswer(400, false, 'Bad Request'); 
    }

  	public function postOrders ()
	{
		if ($this->validate()) 
		{
			if ($this->model->preOrderAuto($this->data))
			{
				return $this->getServerAnswer(200, true, 'order was added successful');
			}
			else
			{
				return $this->getServerAnswer(500, false, 'Internal Server Error');
			}
		}

		return $this->getServerAnswer(400, false, 'Bad Request');  
	}

	public function putOrders ()
	{
		if ($this->validate()) 
		{
			if ($this->model->updateOrderStatus($this->data))
			{
				return $this->getServerAnswer(200, true, 'order status change successful');
			}
			else
			{
				return $this->getServerAnswer(500, false, 'Internal Server Error');
			}
		}
		return $this->getServerAnswer(400, false, 'Bad Request');  
	}
}
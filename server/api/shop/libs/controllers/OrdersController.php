<?php
namespace controllers;
use \Exception;

class OrdersController extends \core\Controller
{
	protected $model;

	protected $rules = [
		'auto_id' 		=> 'integer',
		'user_id' 		=> 'integer',
		'name' 			=> 'string',
		'surname' 		=> 'string',
		'payment_id'	=> 'integer'
	];


    public function __construct ()
    {
        $this->model = new \models\OrdersModel();
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
}
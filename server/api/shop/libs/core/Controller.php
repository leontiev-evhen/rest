<?php
namespace core;

class Controller
{
    protected $model;
    protected $rules;
    protected $data;

    public function __construct ()
    {
       
    }

    protected function validate ()
    {
    	$this->data = $this->getData();
    	foreach ($this->data as $key=>$item) 
        {
            if (!isset($this->rules[$key]) || gettype($item) != $this->rules[$key]) 
            {
                return false;
            } 
        }
        return true;
    }

    protected function getData ()
    {
    	$json = file_get_contents('php://input');
    	return json_decode($json);
    }

    protected function getServerAnswer ($code, $success, $message, $data = [])
    {
    	header('HTTP/1.0 '.$code, $message);
    	return ['status' => $code, 'success' => $success, 'message' => $message, 'data' => $data];
    }
}

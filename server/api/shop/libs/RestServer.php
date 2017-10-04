<?php

class RestServer
{

	public static function run ()
	{
		$HTTPMethod = $_SERVER['REQUEST_METHOD'];
		$url = $_SERVER['REQUEST_URI'];
		list($s, $a, $d, $db, $class, $method, $params) = explode('/', $url);
		
		$className = 'controllers\\'.ucfirst($class).'Controller';

		if (class_exists($className))
		{
			$controller = new $className;
			$method = self::checkMethod($method);
			$type = (isset($_GET['type'])) ? $_GET['type']: TYPE;
			
			switch($HTTPMethod)
			{
			    case 'GET':
			        self::setMethod($controller, 'get'.$method, $type, explode('/', $params));
			        break;
			    case 'DELETE':
			        self::setMethod('delete'.ucfirst($class), explode('/', $params));
			        break;
			    case 'POST':
			        self::setMethod('post'.ucfirst($class), explode('/', $params));
			        break;
			    case 'PUT':
			        self::setMethod($controller, 'put'.ucfirst($class), explode('/', $params));
			        break;
			    default:
			        return false;
			}
		}
		else
		{
			header('HTTP/1.0 400 Forbidden');
			throw new Exception ('Bad Request');
		}
	}

	private function setMethod($class, $method, $type, $param = false)
	{
	    if ( method_exists($class, $method) )
	    {
	        $data = call_user_func([$class, $method]);
	        \helpers\ConverterHelper::chooseTypeOutput($data, $type);
	    }
	}

	private function checkMethod ($method)
	{
		return (strstr($method, '_')) ? implode('', array_map('ucfirst', explode('_', $method))): $method;
	}
}
<?php

class RestServer
{

	public static function run ()
	{
		$HTTPMethod = $_SERVER['REQUEST_METHOD'];
		$url = $_SERVER['REQUEST_URI'];
		list($s, $a, $d, $db, $class, $params) = array_pad(explode('/', $url, 6), 6, null);
												
		
        $className = 'controllers\\'.ucfirst($class).'Controller';
 
		if (class_exists($className))
		{
			$controller = new $className;
            $type = (preg_match('#(\.[a-z]+)#', $url, $match)) ? $match[0] : TYPE;
            $params = trim($params, '/'.$type);
           
			switch($HTTPMethod)
			{
            	case 'GET':
                    if (!empty($params))
                    {
                        $method = 'AutoById';
                    }
                    else
                    {
                        $method = 'Auto';
                    }
			        self::setMethod($controller, 'get'.$method, $type, $params);
			        break;
			    case 'DELETE':
			        self::setMethod('delete'.ucfirst($class), explode('/', $params));
			        break;
			    case 'POST':
			        self::setMethod($controller, 'post'.ucfirst($class), explode('/', $params));
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
            if ($param)
            {
                $data = call_user_func_array([$class, $method],[$param]);
            }
            else
            {
                $data = call_user_func([$class, $method]);
            }
	        \helpers\ConverterHelper::chooseTypeOutput($data, $type);
	    }
	}
}

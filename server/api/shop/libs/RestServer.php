<?php

class RestServer
{
    private static $type;

    public static function run ()
    {

        $HTTPMethod = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        list($t, $s, $a, $d, $db, $class, $params) = array_pad(explode('/', $url, 7), 7, null);


        $className = 'controllers\\'.ucfirst($class).'Controller';

        if (class_exists($className))
        {
            $controller = new $className;
            self::$type = (preg_match('#(\.[a-z]+)#', $url, $match)) ? $match[0] : TYPE;
         
            $params = ltrim($params, self::$type);

            switch($HTTPMethod)
            {
                case 'GET':
                    self::setMethod($controller, 'get'.ucfirst($class), $params);
                    break;
                case 'DELETE':
                    self::setMethod('delete'.ucfirst($class), $params);
                    break;
                case 'POST':
                    self::setMethod($controller, 'post'.ucfirst($class), $params);
                    break;
                case 'PUT':
                    self::setMethod($controller, 'put'.ucfirst($class), $params);
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

    private function setMethod($class, $method, $param = false)
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
            \helpers\ConverterHelper::chooseTypeOutput($data, self::$type);
        }
    }
}

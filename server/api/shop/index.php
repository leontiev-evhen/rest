<?php
require_once 'config.php';
require_once 'helper/ConverterHelper.php';
spl_autoload_register(function ($class_name) 
{
    require_once 'libs/'.$class_name . '.php';
});

try
{
    $method = $_SERVER['REQUEST_METHOD'];
    $auto = new AutoController();
    $url = explode('/', $_SERVER['REQUEST_URI']);
    print_r($_GET['type']);
    switch($method)
    {
    case 'GET':
        echo ConverterHelper::chooseTypeOutput($auto->getAuto());
        break;
    case 'DELETE':
        echo 'delete';
        break;
    case 'POST':
        echo 'post';
        break;
    case 'PUT':
        echo 'put';
        break;
    default:
        return false;
    }
}
catch (Exception $e) 
{
    echo "Error: " . $e->getMessage();
}

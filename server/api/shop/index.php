<?php
require_once 'config.php';
require_once 'Autoloader.php';

try
{
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
	header("Access-Control-Allow-Headers: Authorization, Content-Type");
	
	
    RestServer::run();
}
catch (Exception $e)
{
    echo $e->getMessage();
}



   




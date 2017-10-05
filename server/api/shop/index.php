<?php
require_once 'config.php';
require_once 'Autoloader.php';

try
{
	header("Access-Control-Allow-Origin:*");
    RestServer::run();
}
catch (Exception $e)
{
    echo $e->getMessage();
}



   




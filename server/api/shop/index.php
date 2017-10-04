<?php
require_once 'config.php';
require_once 'Autoloader.php';

try
{
    RestServer::run();
}
catch (Exception $e)
{
    echo $e->getMessage();
}



   




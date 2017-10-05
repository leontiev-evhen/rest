<?php
namespace core;
use \PDO;

class Model extends \core\db\Sql
{
    protected $connect;

    public function __construct ()
    {
        if (!$this->connect = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD))
        {
            throw new Exception('Could not connect');
        }
    }
}
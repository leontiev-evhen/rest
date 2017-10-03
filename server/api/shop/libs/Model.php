<?php
class Model extends Sql
{
    private $connect;
    public function __construct ()
    {
        if (!$this->connect = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD))
        {
            throw new Exception('Could not connect');
        }
    }

    public function getAuto ()
    {
        $sql = $this->select([
            'auto.id as ID',
            'model.name as MODEL_NAME',
            'mark.name as MARK_NAME',
            'mark.image as IMAGE'])
            ->from('auto')
            ->join('left', 'model', 'model.id = auto.model_id')
            ->join('left', 'mark', 'mark.id = model.mark_id')
            ->execute();
        $STH = $this->connect->query($sql);
        return $STH->fetchAll();
    }
}

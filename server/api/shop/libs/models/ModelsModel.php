<?php
namespace models;

class ModelsModel extends \core\Model
{
	public function getModelAuto ()
    {
        $sql = $this->select([
            'id',
            'name'])
        ->from('model')
        ->execute();
        $STH = $this->connect->query($sql);
        return $STH->fetchAll();
    }
}
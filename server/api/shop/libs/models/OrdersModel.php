<?php
namespace models;
use \PDO;

class OrdersModel extends \core\Model
{
	public function preOrderAuto ($data)
    {
        $sql = $this->insert()
            ->from('orders')
            ->values([
            'auto_id' => '<?>',
            'user_id' => '<?>',
            'name' => '<?>',
            'surname' => '<?>',
            'payment_id' => '<?>'])
           ->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $STH->bindParam(1, $data->auto_id);
        $STH->bindParam(2, $data->user_id);
        $STH->bindParam(3, $data->name);
        $STH->bindParam(4, $data->surname);
        $STH->bindParam(5, $data->payment_id);
        if ($STH->execute())
        {
            return true;
        }  
        return false;
    }
}
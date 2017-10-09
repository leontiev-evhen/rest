<?php
namespace models;
use \PDO;

class OrdersModel extends \core\Model
{
    private $table = 'orders';

	public function preOrderAuto ($data)
    {
        $sql = $this->insert()
            ->from($this->table)
            ->values([
            'auto_id' => '<?>',
            'user_id' => '<?>',
            'payment_id' => '<?>'])
           ->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $STH->bindParam(1, $data->auto_id);
        $STH->bindParam(2, $data->user_id);
        $STH->bindParam(3, $data->payment_id);
        if ($STH->execute())
        {
            return true;
        }  
        return false;
    }

    public function getUserOrders ($id)
    {
        $sql = $this->select([
                'model.name',
                'auto.image',
                'orders.id as ID',
                'orders.status'])
            ->from($this->table)
            ->join('left', 'auto', 'auto.id = orders.auto_id')
            ->join('left', 'model', 'model.id = auto.model_id')
            ->where(['orders.user_id' => "<:id>"])
           ->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        if ($STH->execute([':id' => $id]))
        {
            return $STH->fetchAll();
        }  
        return false;
    }

    public function updateOrderStatus ($data)
    {
        $sql = $this->update()
            ->from($this->table)
            ->set(['status' => '<?>',])
            ->where(['id' => '<?>'])
            ->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
        $STH->bindParam(1, $data->status);
        $STH->bindParam(2, $data->id);

        if ($STH->execute())
        {
            return true;
        }  
        return false;
    }
}
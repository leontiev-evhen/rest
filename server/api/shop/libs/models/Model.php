<?php
namespace models;
use \PDO;

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
    
    public function getAutoInfo ($id)
    {
        $sql = $this->select([
            'auto.id as ID',
            'auto.color',
            'auto.price',
            'auto.image',
            'model.name as MODEL_NAME',
            'model.year',
            'model.engine_capacity',
            'model.max_speed'])
        ->from('auto')
        ->join('left', 'model', 'model.id = auto.model_id')
        ->where(['auto.id' => "<:id>"])
        ->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $STH->execute([':id' => $id]);
        return $STH->fetch();
    }

    public function preOrderAuto ($data)
    {
        $sql = $this->insert()
            ->from('orders')
            ->values([
            'auto_id' => '<?>',
            'name' => '<?>',
            'surname' => '<?>',
            'payment_id' => '<?>'])
           ->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $STH->bindParam(1, $data->auto_id);
        $STH->bindParam(2, $data->name);
        $STH->bindParam(3, $data->surname);
        $STH->bindParam(4, $data->payment_id);
        if ($STH->execute())
        {
            return true;
        }  
        return false;
    }

    public function filterAuto ($data)
    {
        $sql = $this->select([
            'auto.id as ID',
            'model.name as MODEL_NAME',
            'mark.name as MARK_NAME',
            'mark.image as IMAGE'])
        ->from('auto')
        ->join('left', 'model', 'model.id = auto.model_id')
        ->join('left', 'mark', 'mark.id = model.mark_id');
        
        //filter year
        if (!empty($data->year))
        {
            $sql = $this->where(['model.year' => "<:year>"]);
        }
        //filter model id
        if (!empty($data->model_id))
        {
            $sql = $this->where(['auto.model_id' => "<:model_id>"], 'and');
        }
        //filter engine capacity
        if (!empty($data->engine_capacity))
        {
            $sql = $this->where(['model.engine_capacity' => "<:engine_capacity>"], 'and');
        }
        //filter engine color
        if (!empty($data->color))
        {
            $sql = $this->where(['auto.color' => "<:color>"], 'and');
        }
        //filter max speed
        if (!empty($data->max_speed))
        {
            $sql = $this->where(['model.max_speed' => "<:max_speed>"], 'and', '<=');
        }
        //filter max speed
        if (!empty($data->price))
        {
            $sql = $this->where(['auto.price' => "<:price>"], 'and', '<=');
        }
        
        $sql = $this->execute();
       
        $sql = str_replace(["'<", ">'"], '', $sql);
       
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        if (!empty($data->year))
        {
            $STH->bindParam(':year', $data->year);
        }
        if (!empty($data->model_id))
        {
            $STH->bindParam(':model_id', $data->model_id);
        }
        if (!empty($data->engine_capacity))
        {
            $STH->bindParam(':engine_capacity', $data->engine_capacity);
        }
        if (!empty($data->color))
        {
            $STH->bindParam(':color', $data->color);
        }
        if (!empty($data->max_speed))
        {
            $STH->bindParam(':max_speed', $data->max_speed);
        }
        if (!empty($data->price))
        {
            $STH->bindParam(':price', $data->price);
        }
        $STH->execute();
        return $STH->fetchAll();
    }

}

<?php
namespace models;
use \PDO;

class AutoModel extends \core\Model
{

    public function getAuto ()
    {
        $sql = $this->select([
            'auto.id as ID',
            'auto.color',
            'auto.price',
            'auto.model_id',
            'model.name as MODEL_NAME',
            'model.year',
            'model.engine_capacity',
            'model.max_speed',
            'mark.name as MARK_NAME',
            'mark.image as IMAGE',
            ])
            ->from('auto')
            ->join('left', 'model', 'model.id = auto.model_id')
            ->join('left', 'mark', 'mark.id = model.mark_id')
            ->execute();
        $STH = $this->connect->query($sql);
        return $STH->fetchAll();
    }

    public function getAutoById ($id)
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
}

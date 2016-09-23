<?php
namespace app\commands\db;

use Yii;

class Query extends \yii\db\Query
{

    public function every($limit=null, $db=null, $call_user_func)
    {
        $query = clone $this;
        $limit = $limit? $limit:1000;
        $db = $db? $db : Yii::$app->db;

        $countTotal = $this->count('*', $db);

        for($offset=0; $offset<$countTotal; $offset+=$limit) {
            $q = clone $query;
            $records = $q->offset($offset)->limit($limit)->all($db);
            foreach( $records as $record ) {
                call_user_func($call_user_func, $record);
            }
        }
    }

}

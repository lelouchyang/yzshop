<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class AideController extends Controller
{

    /**
     * 修补地区数据
     */
    public function actionSysArea()
    {
        $records = \app\mysite\models\SysArea::find()
            ->where(['parent_id'=>0])
            ->all();
        if ( $records) {
            $this->_repairArea($records);
        }
    }

    protected function _repairArea($records)
    {
        foreach( $records as $record ) 
        {
            $record->save();
            $id = $record['id'];
            $areas = \app\mysite\models\SysArea::find()
                        ->where(['parent_id'=>$id])
                        ->all();
            if ( $areas ) {
                foreach( $areas as $area ) {
                    $area->save();
                    print $area . "\n";
                    $subAreas = \app\mysite\models\SysArea::find()
                        ->where(['parent_id'=>$area->id])
                        ->all();
                    if ( $subAreas ) {
                        static::_repairArea($subAreas);
                    }
                }
            }
        }
        return true;
    }
}

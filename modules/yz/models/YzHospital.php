<?php
namespace app\modules\yz\models;

use Yii;
use app\mysite\db\ActiveRecord;
use app\mysite\helpers\Geo;
use app\mysite\helpers\ArrayHelper;

/**
 * 医院模型
 */
class YzHospital extends ActiveRecord 
{

    public static function getDb()
    {
        return \Yii::$app->dbyz;  
    }

    /**
     * 返回医院列表
     */
    public static function getList($lng=null, $lat=null)
    {
        
        $fields = [ 'id', 'name', 'address', 'longitude', 
                    'latitude', 'province', 'city' ];

        $records = static::find()
                        ->where(['=', 'valid', 1])
                        ->select($fields)
                        ->asArray()
                        ->all();

        // 没传经纬度返回所有
        if ( !$lng || !$lat ) 
        {
            return $records;
        }

        foreach($records as &$record) 
        {
            $lng   = (double) $lng;
            $lat   = (double) $lat;
            $t_lng = (double) $record['longitude'];
            $t_lat = (double) $record['latitude'];
            $mile  = Geo::distance($lng, $lat, $t_lng, $t_lat);
            $record['distance'] = $mile;
        } unset($record);

        $records = ArrayHelper::index($records, 'distance');
        ksort($records);
        
        // 距离限制 TODO
        $hosDistance = getParams('hosDistance', 5000);
        foreach($records as $dis=>$item) {
            if ( $dis > $hosDistance ) {
                unset($records[$dis]);
            }
        }
        // 距离限制 end

        $records = array_values($records);

        return array_slice($records, 0, 10);
    }

    /**
     * 获取医院的树状数组
     */
    static public function getTree()
    {
        $hospitals = static::getList();
        $pList = array_unique(arrGetColumn($hospitals, 'province'));
        $retval = [];
        foreach( $pList as $p ) 
        {
            $retval[$p] = [];
        }

        foreach( $hospitals as $hos ) {
            $retval[$hos['province']][] = $hos;
        }

        return $retval;
    }   




}

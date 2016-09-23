<?php
namespace app\modules\yz\models;

use Yii;
use app\mysite\db\ActiveRecord;

/**
 * 医疗平台用户表
 */
class YzUsers extends ActiveRecord 
{

    public static function getDb()
    {
        return \Yii::$app->dbyz;  
    }

}

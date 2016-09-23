<?php
namespace app\modules\app\models;

use Yii;
use app\mysite\db\ActiveRecord;
use \app\modules\shop\models\Shop;

/**
 * app 反馈信息表
 */
class AppFeedback extends ActiveRecord 
{
	public function getShop() {  
        return $this->hasOne(Shop::className(),['id'=>'shop_id']);  
	}
}

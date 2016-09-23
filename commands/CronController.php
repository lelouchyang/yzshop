<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\mysite\models\AuthUser;
use app\mysite\models\AuthRole;
use app\modules\shop\models\Shop;
use app\modules\shop\models\ShopGoods;
use app\modules\shop\models\ShopGoodsCategory;
use app\modules\shop\models\ShopHospital;
use app\modules\shop\models\ShopTag;
use app\modules\shop\models\ShopType;
use app\modules\order\models\OrderInfo;
use app\modules\yz\models\YzHospital;
use app\modules\yz\models\YzUsers;
use app\modules\score\models\Score;
use app\modules\comment\models\Comment;
use app\mysite\helpers\DateTime;
use yii\db\Query;


class CronController extends Controller
{

    /**
     * @name 计算商户平均分和月平均销量
     */
    public function actionShopSta()
    {
        
        $query = new Query();
        $records = $query->from('shop')->where(['status' => 1]);

        foreach($records->each(1000, Yii::$app->db) as $shop) 
        {
            $Shop = Shop::findOne($shop['id']);
            # 计算平均分
            $Shop->calScoreAvg();
            # 计算平均月单
            $Shop->calMonthAvgAmount();
        }
    }

    /**
     * 计算每个商品的统计数据
     */
    public function actionCalGoods()
    {
        $query = new Query();
        $records = $query->from('shop_goods')->where(['status' => 1]);
        foreach($records->each(1000, Yii::$app->db) as $goods) 
        {
            $Goods = ShopGoods::findOne($goods['id']);
            $Goods->calCommentAmount();
            $Goods->calAvgScore();
            $Goods->calMonthAvgAmount();
        }
    }


    /**
     * @name 计算商户到医院的距离
     */
    public function actionCalDistance()
    {
        $query = new Query();
        $records = $query->from('shop')->where(['status' => 1]);

        foreach($records->each(1000, Yii::$app->db) as $shop) 
        {
            $Shop = Shop::findOne($shop['id']);
            $Shop->calDistance();
        }
    }

}

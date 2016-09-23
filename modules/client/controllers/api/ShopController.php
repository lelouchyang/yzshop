<?php
namespace app\modules\client\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use app\modules\shop\models\Shop;
use app\modules\shop\models\ShopType;
use app\modules\shop\models\ShopTag;
use app\modules\shop\models\ShopGoods;
use \app\modules\comment\models\Comment;
use \app\modules\order\models\OrderInfo;
use \app\modules\score\models\Score;

/**
 * @name 店铺相关Api
 */
class ShopController extends ApiController
{
    /**
     * @name 店铺列表
     */
    public function actionIndex()
    {
        # 医院ID
        $hosId      = $this->fetchParams('hos_id');
        # 店铺类型
        $shopTypeId = $this->fetchParams('shop_type_id');
        # 行业标签
        $typeTagId  = $this->fetchParams('type_tag_id');
        # 排序目标
        $orderBy    = $this->fetchParams('order_by', 'month_avg_amount');
        if ( $orderBy === '') {
            $orderBy = 'month_avg_amount';
        }

        # 排序方向
        $orderDir   = $this->fetchParams('order_dir', 'DESC');

        if ( $orderBy == 'allow_price') {
            $orderDir = 'ASC';
        
        }
        # 数量
        $amount     = $this->fetchParams('amount', 100);
        // 当前页面
        $page       = $this->fetchParams('page', 1);

        if ( !$hosId) 
        {
            throw new \Exception('缺少医院id');
        }
        if ( !$shopTypeId) 
        {
            throw new \Exception('缺少商铺类型id');
        }

        $whereTags = '';
        if ( $typeTagId && $ShopTag=ShopTag::findOne($typeTagId)) {
            $shopIds = $ShopTag->shopIds;
            if ( $shopIds ) {
                $shopIds = implode(',',$shopIds);
                $whereTags = "AND shop.id IN ($shopIds)";
            } else {
                $whereTags = "AND shop.id = -1";  // 不存在
            }
        }

        // 搜数据库中获取shop信息
        // 数量
        $countSql = <<<SQL
SELECT count(shop.id) 
FROM `shop` INNER JOIN `shop_hospital` AS sh ON sh.`shop_id` = shop.id
WHERE sh.hospital_id = :hos_id  
AND shop.`shop_type_id` = :type_id 
AND shop.`status` = 1 $whereTags
SQL;

        $totalAmount = Query($countSql)
                        ->bindValue(':hos_id', (int)$hosId)
                        ->bindValue(':type_id',(int)$shopTypeId)
                        ->queryScalar();
        
        $offset = ($page-1) * $amount;
// ----------------------------------------------------------------------------        
        $querySql = <<<SQL
SELECT shop.*,sh.distance,sh.hospital_id
FROM `shop` INNER JOIN `shop_hospital` AS sh ON sh.`shop_id` = shop.id
WHERE sh.hospital_id = :hos_id  
AND shop.`shop_type_id` = :type_id 
AND shop.`status` = 1 $whereTags
ORDER BY shop.$orderBy $orderDir
LIMIT :limit
OFFSET :offset
SQL;

        $shops = Query($querySql)
                    ->bindValue(':hos_id', (int)$hosId)
                    ->bindValue(':type_id',(int) $shopTypeId)
                    ->bindValue(':limit', (int)$amount)
                    ->bindValue(':offset', (int)$offset)
                    ->queryAll();

        // 加工数据
        foreach( $shops as &$shop )
        {
            $shop['cover_url'] = dImg($shop['cover'], 150,150);
            $distance = $shop['distance'];
            if ( $distance == 0 ) {
                $distance = '';
            } else if ( $distance > 999 ) {
                $distance = round($distance/1000, 2).' 千米';
            } else {
                $distance = $distance.'米';
            }
            $shop['distance'] = $distance;

            if ( $totalAmount < getParams('shopLowNum', 30) ) {
                $shop['goodsList'] = $this->getShopGoods($shop['id'],5);
            } else {
                $shop['goodsList'] = [];
            }

            $shop['is_open'] = $this->isOpen($shop);

        } unset($shop);

        $this->datas['shops'] = $shops;
        $this->datas['shopTypes'] = ShopType::allInfo();
        $this->datas['shopAmount'] = Shop::typeCount($hosId, $shopTypeId);
        $this->datas['totalAmount'] = $totalAmount;
    }

    /**
     * 判断一个商铺是否营业
     */ 
    protected function isOpen($shop)
    {
        if ( $shop['sys_status'] == 0) 
        {
            return false;
        }

        if ( $shop['user_status'] == 0 ) {
            return false;
        }

        if ( $shop['start_time'] == '00:00:00' && 
            $shop['end_time'] == '00:00:00' )  {
            return true;
        }

        $s = strtotime(date('Y-m-d '.$shop['start_time']));
        $e = strtotime(date('Y-m-d '.$shop['end_time']));
        $n = time();

        return $n >= $s && $n <= $e;
    }

    
    protected function getShopGoods($shop_id, $amount=10)
    {
        $goodsList = ShopGoods::find()
                        ->where(['status'=>1, 'shop_id'=>$shop_id])
                        ->orderBy('month_avg_amount', 'DESC')
                        ->limit($amount)
                        ->all();
        foreach( $goodsList as &$item ) {
            $item = $item->toArray();
            $item['cover_url'] = dImg($item['cover'], 200, 200);
        } unset($item);

        return $goodsList;
    }



    /**
     * @name 获取商铺类型
     */
    public function actionType()
    {
        $shopTypeList = ShopType::allInfo();

        $this->datas = [
            'shopTypeList' => $shopTypeList,
        ];
    }

    /**
     * 获取店铺信息
     */
    public function actionInfo()
    {
        $shopId = $this->fetchParams('shop_id');
        if ( !$shopId ) 
        {
            throw new \Exception('缺少商铺id');
        }
        $Shop = Shop::findOne(['id'=>$shopId, 'status'=>1]);
        if ( !$shopId ) 
        {
            throw new \Exception('商铺不存在');
        }

        $shopInfo = $Shop->allInfo;
        $this->datas['shopInfo']= $Shop->allInfo;
    }


}

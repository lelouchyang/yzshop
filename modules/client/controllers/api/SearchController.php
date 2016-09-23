<?php
namespace app\modules\client\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use app\modules\shop\models\shop;

/**
 * @name 搜索控制器
 */
class SearchController extends ApiController
{
    /**
     * @name 搜索商品
     */
    public function actionGoods()
    {
    	$goodsName = $this->fetchParams('goods_name');
    	$hospitalId = $this->fetchParams('hos_id');
    	$amount = $this->fetchParams('amount', 30);
        $page = $this->fetchParams('page', 1);
        if ( !$hospitalId) 
        {
            throw new \Exception('缺少医院id');
        }
        if ( !$goodsName) 
        {
            throw new \Exception('缺少搜索值');
        }
        // 搜数据库中获取shop信息
        // 数量

        $countSql = <<<SQL
select count(*) from shop_goods as a
inner join shop as b on a.shop_id = b.id
inner join shop_hospital as c on c.shop_id = b.id
where c.hospital_id=:hos_id and a.`status` = 1
and a.name like :goods_name
SQL;
        $totalAmount = Query($countSql)
                    ->bindValue(':hos_id', (int)$hospitalId)
                    ->bindValue(':goods_name', '%'.$goodsName.'%')                    
                    ->queryScalar();
        $offset = ($page-1) * $amount;

$querySql = <<<SQL
select a.name as goods_name,a.price,a.cover,b.name as shop_name
from shop_goods as a
inner join shop as b on a.shop_id = b.id
inner join shop_hospital as c on c.shop_id = b.id
where c.hospital_id=:hos_id
and a.name like :goods_name and a.`status` = 1
ORDER BY a.`created`
LIMIT :limit
OFFSET :offset
SQL;

		$goods = Query($querySql)
                    ->bindValue(':hos_id', (int)$hospitalId) 
                    ->bindValue(':limit', (int)$amount)
                    ->bindValue(':offset', (int)$offset)
                    ->bindValue(':goods_name', '%'.$goodsName.'%')
                    ->queryAll();
       // 加工数据
        foreach( $goods as &$good )
        {
            $good['cover'] = getImageUrl($good['cover']);
        
        } unset($good);
        $this->datas['goods'] = $goods;
        $this->datas['totalAmount'] = $totalAmount;

    }

    /**
     * @name 搜索商铺
     */
    public function actionShop()
    {
   	
    }
}

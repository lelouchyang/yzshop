<?php
namespace app\modules\client\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\shop\models\Shop;
use \app\modules\shop\models\ShopGoods as Goods;

/**
 * @name 店铺相关Api
 */
class GoodsController extends ApiController
{

    /**
     * @name 获取指定店铺的商品列表
     */
    public function actionIndex()
    {
        $shopId = $this->fetchParams('shop_id');

        if ( !$shopId ) {
            throw new \Exception('却少不要参数');
        }

        $Shop = Shop::findOne($shopId);
        $goodsInfo = $Shop->goodsInfo;
        $Shop = toArray($Shop);
        $Shop['is_open'] = shopIsOpen($Shop);

        foreach( $goodsInfo as $key=>$cate) {
            if ( !$cate['goods'] ) {
                unset($goodsInfo[$key]); 
            }
        }

        $this->datas['goodsInfo'] = $goodsInfo;
        $this->datas['shopInfo'] = $Shop;
    }

    /**
     * @name 获取商品详情
     */
    public function actionDetail()
    {
        $id = $this->fetchParams('id');

        if ( !$id ) {
            throw new \Exception('却少必要参数');
        }

        $Goods = Goods::findOne(['id'=>$id, 'status'=>1]);
        $comments = $Goods->comments;
        $goodsInfo = $Goods->getAllInfo(640, 380);
        $goodsInfo['comments'] = [];

        foreach( $comments as $item ) 
        {
            $comment = toArray($item);
            $score = $item->score;
            if ( $score ) {
                $comment['score'] = $score->score;
            } else {
                $comment['score'] = 0;
            }
            $goodsInfo['comments'][] = $comment;
        }

        $shopId = $Goods->shop_id;
        $Shop = Shop::findOne($shopId);
        $Shop = toArray($Shop);
        $Shop['is_open'] = shopIsOpen($Shop);

        $this->datas['goodsInfo'] = $goodsInfo;
        $this->datas['shopInfo'] = $Shop;

    
    }

}

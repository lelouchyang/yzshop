<?php
namespace app\modules\client\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\shop\models\Shop;
use \app\modules\shop\models\ShopGoods;
use \app\modules\order\models\OrderInfo;
use \app\modules\order\models\OrderDetail;
use \app\mysite\helpers\DateTime;


/**
 * @name 订单相关Api
 */
class OrderController extends ApiController
{

    /**
     * @name 向系统添加一个订单
     */
    public function actionCreate()
    {
        $order = OrderInfo::createOrder($this->params);

        $orderInfo = $order->allInfo;

        $Shop = Shop::findOne($order['shop_id']);

        $proStatusMap = OrderInfo::$proStatusMap;
        $orderInfo['pro_status_txt'] = $proStatusMap[$orderInfo['pro_status']];

        $message = [
            'title'          => '云智商户订单提醒',
            'description'    => OrderInfo::genMessage($orderInfo),
            'custom_content' => ['orderInfo' => $orderInfo],
        ];

        // 消息
        if ( $orderInfo['pro_status'] == 2) {
            $Shop->push($message, ['msg_type'=>1]);
            // 透传
            $Shop->push($message, ['msg_type'=>0]);
        }

        $proStatusMap = OrderInfo::$proStatusMap;
        unset( $proStatusMap[0] );
        unset( $proStatusMap[-1] );
        unset( $proStatusMap[9] );

        $this->datas['orderInfo'] = $orderInfo;
        $this->datas['shopInfo'] = $Shop;
        $this->datas['proStatusMap'] = $proStatusMap;
    }

    /**
     * @name 获取一个订单详情
     */
    public function actionDetail()
    {
        //订单id
        $orderId = $this->fetchParams('order_id');
        if ( !$orderId )  
        {
            throw new \Exception('缺少订单号');
        }
        $orderInfo = OrderInfo::findOne($orderId);

        $shopId = $orderInfo['shop_id'];
        $shopInfo = Shop::findOne($shopId);

        $proStatusMap = OrderInfo::$proStatusMap;
        unset( $proStatusMap[0] );
        unset( $proStatusMap[9] );

        $shopInfo = toArray($shopInfo);
        $shopInfo['cover_small_url'] = dImg($shopInfo['cover'], 150, 150);
        $this->datas['orderInfo']    = $orderInfo->allInfo;
        $this->datas['shopInfo']     = $shopInfo;
        $this->datas['proStatusMap'] = $proStatusMap;
        $this->datas['payMethodMap'] = OrderInfo::$payMethodMap;

    }

    
    /**
     * 确认订单收获
     */ 
    public function actionConfirm()
    {
        $orderId = $this->fetchParams('order_id');
        $customerId = $this->fetchParams('customer_id');
        if ( !$orderId || !$customerId ) 
        {
            throw new \Exception('参数错误');
        }
        $orderInfo = OrderInfo::findOne(['id'=>$orderId, 'status'=>1]);
        
        if ( !$orderInfo || $orderInfo['customer_id'] != $customerId ) 
        {
            throw new \Exception('订单或用户错误');
        }

        if ( $orderInfo->pro_status > 6 ) 
        {
            throw new \Exception('订单已经确认收获');
        }

        $orderInfo->pro_status = 6;
        $orderInfo->save();

        $orderInfo = $orderInfo->allInfo;
        $shopInfo = Shop::findOne($orderInfo['shop_id']);
        $shopInfo = $shopInfo->allInfo;

        $this->datas = [
            'orderInfo' => $orderInfo,
            'shopInfo'  => $shopInfo,
        ];
    
    }

     



     /**
     * @name 想指定订单添加一个商品
     */
    public function actionList()
    {
        $customerId = $this->fetchParams('customer_id');
        $proStatus = $this->fetchParams('pro_status');
        $amount = $this->fetchParams('amount', 100);
        $page = $this->fetchParams('page', 1);

        if ( !$customerId ) 
        {
            throw new \Exception('缺少客户id');
        }

        $query = OrderInfo::find()
                    ->where([ 'status'=>1, 'customer_id'=>$customerId ] );
                    //->andWhere(['<>', 'pro_status', 9]);

        if ( $proStatus != null ) {
            $proStatus = explode(',', $proStatus);
            $query->andWhere(['in','pro_status',$proStatus]);
        }

        $totalAmount = $query->count();

        $offset = $amount*($page-1);

        $records = $query->orderBy('pro_status asc')
                         ->orderBy('created desc')
                         ->limit($amount)
                         ->offset($offset)
                         ->all();

        foreach($records as &$item) {
            $detailCount = $item->detailCount;
            $shopNameCover = $item->shopNameCover;
            $item = toArray($item);
            $item['detail_count'] = $detailCount;
            $item['shop_name'] = $shopNameCover['name'];
            $item['shop_cover'] = $shopNameCover['cover'];
            $item['pro_status_txt'] = OrderInfo::$proStatusMap[$item['pro_status']];
        } unset($item);

        $this->datas['orders']      = $records;
        $this->datas['totalAmount'] = $totalAmount;
        $this->datas['proStatusMap'] = OrderInfo::$proStatusMap;
    }



    /**
     * 检查订单
     */ 
    public function actionCheck()
    {
        $orderId = $this->fetchParams('order_id');
        
        if ( !$orderId) 
        {
            throw new \Exception('参数错误');
        }
        $orderInfo = OrderInfo::findOne(['id'=>$orderId, 'status'=>1]);
        

        $this->datas = [
            'orderStatus' => $orderInfo->pro_status,
        ];
    }
    
    public function actionChangeStatus()
    {
        $order_id    = $this->fetchParams('order_id');
        $pro_status  = $this->fetchParams('pro_status');
        $refund_type = $this->fetchParams('refund_type', 1);

        $this->datas = ['order_id'=>$order_id];

        if ( !$order_id ) 
        {
            throw new \Exception("却少必要的参数");
        }


        $Order = OrderInfo::findOne(['status'=>1, 'id'=>$order_id]);
        if ( !$Order )
        {
            throw new \Exception("订单不存在");        
        }

        $statusMap = array_keys(OrderInfo::$proStatusMap);
        if ( !in_array($pro_status, $statusMap) )
        {
            throw new \Exception("参数值非法");
        }

        $Order->pro_status = $pro_status;
        $Order->refund_type = $refund_type;
        $Order->save();

        $this->datas = ['success' => 1];

    }



}

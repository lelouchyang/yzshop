<?php
namespace app\modules\client\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\comment\models\Comment;
use \app\modules\shop\models\Shop;
use \app\modules\score\models\Score;
use \app\modules\order\models\OrderInfo;

/**
 * @name 评论相关Api
 */
class CommentController extends ApiController
{

    /**
     * 获取评论列表
     */
    public function actionIndex()
    {
    
        $shopId = $this->fetchParams('shop_id');
        $amount = $this->fetchParams('amount', 100);
        $page = $this->fetchParams('page', 1);

        $offset = ($page - 1) * $amount;


        $filter = [
            'own_shop_id' =>$shopId, 
            'res_name'    =>'order_info', 
            'status'      =>1
        ];
        $query = Comment::find()->where($filter)->orderBy('created DESC');

        $totalAmount = $query->count();

        $comments = $query->limit($amount)
                          ->offset($offset)
                          ->all();

        foreach( $comments as &$item ) {
            // 组合订单
            $filter = [
                'id' => $item->res_id,
                'status' => 1   
            ];
            $order       = OrderInfo::findOne($filter);
            $details     = toArray($order->details); 
            $goods_names = arrGetColumn($details, 'goods_name');
            $order       = $order->toArray();
            $order['goods_names'] = implode(',', $goods_names);

            // 组合评论
            $filter = [
                'id' => $item->score_id,
                'status' => 1   
            ];
            $score = Score::findOne($filter);

            $item = $item->toArray();
            $item['order_info'] = $order;
            $item['score'] = toArray($score);

        } unset($item);

        $Shop = Shop::findOne($shopId);
        $scoreInfo = $Shop->scoreInfo;
        $Shop = toArray($Shop);
        $Shop['is_open'] = shopIsOpen($Shop);

        $this->datas['comments'] = $comments;
        $this->datas['shopInfo'] = $Shop;
        $this->datas['scoreInfo'] = $scoreInfo;
        $this->datas['amount'] = $amount;
    }



    /**
     * @name 添加评论
     */
    public function actionAdd()
    {
        $orderId       = $this->fetchParams('order_id');
        $customerId    = $this->fetchParams('customer_id');
        $content       = $this->fetchParams('content');
        $score         = $this->fetchParams('score');
        $goodsComment = $this->fetchParams('goods_comment');

        # 测试 order 合法 
        $OrderInfo = OrderInfo::findOne($orderId);
        // 删除已经有的
        $OrderInfo->delCommentInfo();
        
        if ( !$OrderInfo ) 
        {
            throw new \Exception('订单错误');
        }

        if ( $OrderInfo->customer_id != $customerId ) 
        {
            throw new \Exception('不允许');
        }

        # 商品评论数据整理
        $detailComments = [];
        if ( $goodsComment  ) {
            $goodsComment = explode('|', $goodsComment);
            foreach( $goodsComment as $item) 
            {
                $dc = explode(',', $item);
                if ( count($dc) != 3 ) 
                {
                    // TODO 
                    throw new \Exception('商品评论参数错误');
                }
                $detailComments[] = $dc;
            }
        }

        $transaction = OrderInfo::getDb()->beginTransaction();
        try {
            # 写入score数据
            $Score = new Score();
            if ( $score ) {
                $datas =[
                  'shop_id'     => $OrderInfo->shop_id,
                  'user_id'     => $OrderInfo->own_user_id,
                  'res_name'    => 'order_info',
                  'res_id'      => $orderId,
                  'score'       => $score,
                  'customer_id' => $customerId,
                ];
                $Score->setAttributes($datas, false);
                $Score->insert();
            }

            # 写入comemnt数据
            # 关联 comment score
            $Comment = new Comment();
            if ( $content ) {
                $datas =[
                  'score_id'    => $Score->id? $Score->id:0,
                  'res_name'    => 'order_info',
                  'res_id'      => $orderId,
                  'customer_id' => $customerId,
                  'own_shop_id' => $OrderInfo->shop_id,
                  'own_user_id' => $OrderInfo->own_user_id,
                  'content'     => $content,
                ];
                $Comment->setAttributes($datas, false);
                $Comment->insert();
            }
            # 商品评论和评分
            if ( $detailComments ) {
                foreach($detailComments as $detail) {
                    $detailId = $detail[0];
                    $score    = $detail[1];
                    $content  = $detail[2];
                    # 写入score数据
                    $Score = new Score();
                    if ( $score ) {
                        $datas =[
                             'shop_id'     => $OrderInfo->shop_id,
                             'user_id'     => $OrderInfo->own_user_id,
                             'res_name'    => 'order_detail',
                             'res_id'      => $detailId,
                             'score'       => $score,
                             'customer_id' => $customerId,
                        ];
                        $Score->setAttributes($datas, false);
                        $Score->insert();
                    }
                    # 写入comemnt数据
                    # 关联 comment score
                    $Comment = new Comment();
                    if ( $content ) {
                        $datas =[
                          'score_id'    => $Score->id? $Score->id : 0,
                          'res_name'    => 'order_detail',
                          'res_id'      => $detailId,
                          'customer_id' => $customerId,
                          'own_shop_id' => $OrderInfo->shop_id,
                          'own_user_id' => $OrderInfo->own_user_id,
                          'content'     => $content,
                        ];
                        $Comment->setAttributes($datas, false);
                        $Comment->insert();
                    }
                }
            }

            $transaction->commit();
            $this->datas['orderInfo'] = $OrderInfo->allInfo;
            $this->datas['success'] = 1;
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw new \Exception('添加失败，请稍后在试!'. $e->getMessage());
        }
    }

    

}

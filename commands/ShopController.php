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



class ShopController extends Controller
{

    /**
     * @name 基础数据初始化
     */
    /*
    public function actionInit()
    {
        $this->clean();
    }*/

    /**
     * @name 填充测试数据
     */
    /*
    public function actionTestDatas()
    {
        # 清理数据
        $this->clean();
        
        # 添加账号
        $this->user();

        # 添加商铺/分类/商品
        $this->shop();

        # 添加订单
        $this->order();

        # 添加评论评分 
        $this->comment();
    }*/
    
    /**
     * 清理数据
     */
    protected function clean()
    {
        # 1 清理表
        $cleanTargets = [
            'app_debug', 'app_device','app_feedback', 'app_push','app_session', 
            'app_version', 'auth_valid_code','comment','order_derate',
            'order_detail','order_info','order_payment', 'score', 'shop', 
            'shop_cart','shop_cart_goods', 'shop_goods','shop_goods_category', 
            'shop_hospital','shop_tag_rel','sys_affix', 'sys_affix_rel'
        ];
        $sqlStmt = <<<SQL
TRUNCATE `%s`
SQL;

        foreach( $cleanTargets as $target )
        {
            $sql = sprintf($sqlStmt, $target);
            echo "clean table ".$target."\n";
            Query($sql)->execute();
        }

        # 2 清理用户表
        $sqlStmt = <<<SQL
DELETE FROM `auth_user` WHERE `is_staff` <> 1 AND `is_super` <> 1
SQL;

        Query($sqlStmt)->execute();
        echo "clean table auth_user\n";
        $maxId = Query('SELECT MAX(`id`) FROM `auth_user`')->queryScalar();
        $maxId ++;
        Query('ALTER TABLE `auth_user` AUTO_INCREMENT='.$maxId)->execute();
        echo "set auth_user max id ".$maxId."\n";

        // 开发组
        $Role = AuthRole::findOne(3);

        $users = $Role->users;
        foreach( $users as $user ) 
        {
            $user->is_shop_user = 0;
            $user->save();
        }
    }

    /**
     * 添加账号
     */
    protected function user()
    {
        $Role = AuthRole::findOne(3);

        $mobiles = [];
        $users = $Role->users;
        foreach( $users as $user ) 
        {
            $user->is_shop_user = 1;
            $user->save();
            $mobiles[] = $user->mobile;
        }

        for($i=0; $i<100; $i++) 
        {
            $mobile = 13000000000 + $i;    

            $datas = [
                'username' => $mobile,
                'password' => md5('111111'),
                'mobile'   => $mobile,
                'nickname' => $mobile,
                'realname' => $mobile,
                'is_shop_user' => 1 
            ];
            $User = new AuthUser();
            $User->setAttributes($datas, false);
            $User->insert();
            echo $User->id.' '.$User->username."\n";
        }
    
    }


    /**
     * 添加商铺
     */
    protected function shop()
    {
        $sql = <<<SQL
select id from auth_user where status=1 and is_shop_user=1
SQL;
        $user_ids = Query($sql)->queryColumn();

        $hospitals = YzHospital::getList();

        $shopTypes = ShopType::find()
            ->where(['status'=>1])
            ->all();



        foreach( $user_ids as $user_id ) 
        {
            # 随机医院
            $Hos = [];
            $num = mt_rand(0,2);
            for($i=0; $i<$num; $i++) 
            {
                $key = array_rand( $hospitals, 1 );
                $Hos[] = $hospitals[$key]['id'];
            }
            $Hos[] = 17;

            # 随机商铺类型
            $key = array_rand( $shopTypes, 1 );
            $shopType = $shopTypes[$key];

            # 随机商铺标签
            $shopTypeTags = $shopType->tags;
            $Tags = [];
            if ( $shopTypeTags ) {
                for( $i=0; $i<mt_rand (1, count($shopTypeTags));$i++ ) 
                {
                    $key = array_rand( $shopTypeTags, 1 );
                    $Tags[] = $shopTypeTags[$key]['id'];
                }
            }

            $this->_shop($user_id, $Hos, $shopType, $Tags);
        }
    }

    protected function _shop($user_id, $Hos, $shopType, $Tags)
    {
        $User = AuthUser::findOne($user_id);
        $Shop = new Shop();
        
        $allow_prices = [0, 5, 10, 15];
        $key = array_rand($allow_prices, 1);
        $allow_price = $allow_prices[$key];

        $dfa_prices = [0, 5, 8];
        $key = array_rand($dfa_prices, 1);
        $dfa_price = $dfa_prices[$key];

        # 随机起送价 随机送货费
        $datas = [
            'name'         => $User->mobile.'的'.$shopType->name.'店',
            'shop_type_id' => $shopType->id,
            'allow_price'  => $allow_price,
            'dfa_price'    => $dfa_price,
            'user_id'      => $user_id,
            'user_status'  => 1,
            'is_cod'       => mt_rand(0,1),
        ];

        $Shop = new Shop();
        $Shop->setAttributes($datas, false);
        $Shop->insert();
        $Shop->addHospitals($Hos);
        $Shop->addTags($Tags);
        $Shop = Shop::findOne($Shop->id);

        # 添加商品
        $this->_goods($Shop);

    }

    /**
     * 为店铺添加商品
     */
    protected function _goods($Shop)
    {
        # 添加随机数量的分类
        $cates = [];
        for( $i=0; $i<mt_rand(0,5); $i++ ) 
        {
            $cates[] = '分类'.$i;
        }

        foreach( $cates as $cate ) 
        {
            $Cate = new ShopGoodsCategory();
            $Cate->shop_id = $Shop->id;
            $Cate->user_id = $Shop->user_id;
            $Cate->name = $cate;
            $Cate->insert();
        }

        $Cates = toArray($Shop->goodsCates);

        array_unshift($Cates, ['id'=>0, 'name'=>'默认']);

        $unitNameMap = ['个','份','斤'];

        for( $i=0; $i<mt_rand(20,60); $i++ ) 
        {
            $cate = arrayRand($Cates, 1);

            $unitName = arrayRand($unitNameMap, 1);

            $name = '商品'.$i;

            $datas = 
            [
                'cate_id' => $cate['id'],
                'shop_id' => $Shop->id,
                'user_id' => $Shop->user_id,
                'unit_name' => $unitName,
                'name' => $name,
                'price' => mt_rand(5, 18),
            ];
            
            $Goods = new ShopGoods();
            $Goods->setAttributes($datas, false);
            $Goods->insert();
            echo $Goods->name."\n";
        }

    }

    /**
     * 添加订单信息
     */
    protected function order()
    {
        $sql =<<<SQL
SELECT `id` FROM `shop` WHERE `status`=1
SQL;
        $shopIds = Query($sql)->queryColumn();

        foreach( $shopIds as $ShopId ) 
        {
            $Shop = Shop::findOne($ShopId);
            $this->_order($Shop);
        }
    }

    protected function _order($Shop)
    {

        $hosList = toArray($Shop->hospitals);
        list($goodsList, $amounts) = toArray($Shop->goods);

        
        $users = YzUsers::find()->select(['id'])->asArray()->all();
        $userIds = extractField($users,'id');
         
        for( $i=0; $i<=mt_rand(100,200); $i++ ) 
        // for( $i=0; $i<=10; $i++ ) 
        {
            $userId = arrayRand($userIds, 1);
            $YzUser = YzUsers::findOne($userId);
            $hos = arrayRand($hosList, 1);
            $goods = arrayRand($goodsList, mt_rand(2, 3));

            $goodsInfo = [];

            foreach($goods as $g) 
            {
                $goodsInfo[] = $g['id'].','.mt_rand(1, 2);
            }

            $goodsInfo = implode('|', $goodsInfo);

            $fields = 
            [
                'customer_id' => $userId,
                'hos_id' => $hos['id'],
                'shop_id' => $Shop->id,
                'mobile' => $YzUser->mobile,
                'goods_ids' => $goodsInfo,
                'contact_name' => '',
            ];

            try {

                # 随机时间
                $dtStart = time() - 86400*15;
                //$dtStart = strtotime(date('Y-m-d 00:00:00'));  
                $dtEnd =  time();
                $dt = date('Y-m-d H:i:s', mt_rand($dtStart, $dtEnd));

                # 随机状态
                $proStatusMap = [1,2,4,6];
                $pro_status = arrayRand($proStatusMap, 1);

                $order = OrderInfo::createOrder($fields, $pro_status, $dt);

                /*
                if ( $order['pro_status'] == 2 ) 
                    $orderInfo = $order->allInfo;

                    $Shop = Shop::findOne($order['shop_id']);

                    $message = [
                        'title'          => '云智商户订单提醒',
                        'description'    => OrderInfo::genMessage($orderInfo),
                        'custom_content' => ['orderInfo' => $orderInfo],
                    ];

                    var_dump( $message );
                    // 消息
                    $Shop->push($message, ['msg_type'=>1]);
                    // 透传
                    $Shop->push($message, ['msg_type'=>0]);
                }
                */
                echo $order['created'].' | '.$order['id']."|".$order['pro_status']."\n";
            } catch ( \Exception $e) {
                echo $e->getMessage()."\n";
            
            }
        }


    }

    /**
     * 添加评论信息
     */
    protected function comment()
    {
        $sql = <<<SQL
SELECT `id` FROM `order_info` where pro_status=6
SQL;
        $ids = Query($sql)->queryColumn();
        foreach( $ids as $orderId )
        {
            $Order = OrderInfo::findOne($orderId);
            $OrderDetails = $Order->details;

            $res_name    = 'order_info';
            $res_id      = $orderId;
            $customer_id = $Order->customer_id;
            $content     = '评论内容：生活服务棒棒哒!';
            $score       = mt_rand(1, 5);

            $transaction = OrderInfo::getDb()->beginTransaction();
            try {
                # 写入score数据
                $Score = new Score();
                $datas =[
                  'shop_id'     => $Order->shop_id,
                  'res_name'    => $res_name,
                  'res_id'      => $res_id,
                  'score'       => $score,
                  'customer_id' => $customer_id,
                  'created'     => $Order->created,
                  'updated'     => $Order->created,
                ];
                $Score->setAttributes($datas, false);
                $Score->insert();
                # 写入comemnt数据
                # 关联 comment score
                $Comment = new Comment();
                $datas =[
                  'score_id'    => $Score->id,
                  'res_name'    => $res_name,
                  'res_id'      => $res_id,
                  'customer_id' => $customer_id,
                  'own_shop_id' => $Order->shop_id,
                  'own_user_id' => $Order->own_user_id,
                  'content'     => $content,
                  'created'     => $Order->created,
                  'updated'     => $Order->created,
                ];
                $Comment->setAttributes($datas, false);
                $Comment->insert();

                $content     = '不错的冬冬!';
                $score       = mt_rand(1, 5);
                foreach($OrderDetails as $detail) {
                    # 写入score数据
                    $Score = new Score();
                    $datas =[
                      'shop_id'     => $Order->shop_id,
                      'res_name'    => 'order_detail',
                      'res_id'      => $detail->id,
                      'score'       => $score,
                      'customer_id' => $customer_id,
                      'created'     => $Order->created,
                      'updated'     => $Order->created,
                    ];
                    $Score->setAttributes($datas, false);
                    $Score->insert();
                    # 写入comemnt数据
                    # 关联 comment score
                    $Comment = new Comment();
                    $datas =[
                      'score_id'    => $Score->id,
                      'res_name'    => 'order_detail',
                      'res_id'      => $detail->id,
                      'customer_id' => $customer_id,
                      'own_shop_id' => $Order->shop_id,
                      'own_user_id' => $Order->own_user_id,
                      'content'     => $content,
                      'created'     => $Order->created,
                      'updated'     => $Order->created,
                    ];
                    $Comment->setAttributes($datas, false);
                    $Comment->insert();
                }

                $transaction->commit();
            
                echo $Comment->id."\n";
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw new \Exception('添加失败，请稍后在试!'. $e->getMessage());
            }

        }
            
        
    }
}

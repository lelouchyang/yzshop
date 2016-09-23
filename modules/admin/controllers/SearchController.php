<?php
namespace app\modules\admin\controllers;

use Yii;
use \app\mysite\helpers\Url;
use \app\mysite\web\AdminController;
use \app\modules\shop\models\Shop;
use \app\mysite\models\AuthUser;

/**
 * @name 后台全局搜索控制器
 */
class SearchController extends AdminController
{
    /**
     * @name 搜索商铺ID/mobile
     */
    public function actionShopMobile()
    {
        $shopId = $this->request->get('shop_id');
        $Shop = Shop::findOne(['id'=>$shopId,'status'=>1]);
        if ( !$Shop ) 
        {
            // 尝试作为mobile搜索
            $User = AuthUser::findOne(['status'=>1, 'username'=>$shopId]);
            if ( $User ) {
                $Shop = Shop::findOne(['user_id'=>$User->id,'status'=>1]);
            }
        }

        if ( !$Shop) {
            return "目标商户／商铺不存在!";
        }

        // ajax 调取
        return $this->renderPartial('shop-mobile', ['Shop'=>$Shop]);
        
    }

}


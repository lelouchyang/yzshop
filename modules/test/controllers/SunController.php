<?php
namespace app\modules\test\controllers;

use Yii;
use app\mysite\helpers\StringHelper;
use app\mysite\helpers\AppHelper;
use app\mysite\web\HomeController;
use app\mysite\models\SysAffix;
use app\mysite\models\SysAction;
use app\mysite\models\SysMenu;
use app\modules\comment\models\Comment;
use app\mysite\helpers\FileHelper;
use app\mysite\models\Tag;
use app\mysite\models\Remark;
use app\modules\api\models\AppVersion;
use app\mysite\models\AuthUser;
use app\modules\shop\models\Shop;
use app\modules\shop\models\ShopGoods;
use app\modules\shop\models\ShopTag;
use app\modules\order\models\OrderInfo;
use app\mysite\helpers\ApiHelper;
use Location\Coordinate;
use app\mysite\helpers\DateTime;
use app\mysite\helpers\Sms;
use app\mysite\helpers\Geo;
use app\modules\yz\models\YzUsers;
use app\modules\yz\models\YzHospital;

/**
 * @name isme.sun的测试控制器
 */
class SunController extends HomeController
{

    /**
     * @name 临时测试
     */
    public function actionIndex()
    {
        $rs = Shop::typeCount(17, 1);
        dump(toArray($rs));
        echo "<br />";
        $rs = Shop::typeCount(17, 2);
        dump(toArray($rs));
        echo "<br />";
        $rs = Shop::typeCount(17, 3);
        dump(toArray($rs));
        echo "<br />";
        $rs = Shop::typeCount(17, 4);
        dump(toArray($rs));

    }

    public function actionT1()
    {

    }

    public function actionT2()
    {

    }

}

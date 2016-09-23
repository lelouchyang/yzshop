<?php
namespace app\modules\ui\controllers;

use Yii;
use \app\mysite\web\HomeController;
use \app\mysite\models\SysAction;

/**
 * @name 前台设计控制器
 */
class PageController extends HomeController
{
    /**
     * @name UI路由
     */
    public function actionIndex($path)
    {
        return $this->renderPartial($path);
    }
}

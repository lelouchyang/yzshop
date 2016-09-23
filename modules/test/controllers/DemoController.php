<?php
namespace app\modules\test\controllers;

use Yii;
use app\mysite\web\HomeController;

/**
 * @name 一些演示
 */
class DemoController extends HomeController
{

    /**
     * @name 路由演示
     */
    public function actionRoute()
    {
        return $this->render('route');
    }


    public function actionZf()
    {
        return $this->renderPartial('zf');
    }

}

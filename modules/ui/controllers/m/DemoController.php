<?php
namespace app\modules\ui\controllers\m;

use Yii;
use \app\mysite\web\MController;

/**
 * @name 移动端演示
 */
class DemoController extends MController
{
    /**
     * @name 简单演示
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @name 移动端图标
     */
    public function actionMobileIcon()
    {
        return $this->render('mobile-icon');
    }

}

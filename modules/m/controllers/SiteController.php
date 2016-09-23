<?php
namespace app\modules\m\controllers;

use Yii;
use \app\mysite\helpers\Url;
use \app\mysite\web\MController;

/**
 * @name 移动端普通入口
 */
class SiteController extends MController
{
    /**
     * @name 后台首页入口
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}


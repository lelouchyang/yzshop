<?php
namespace app\modules\app\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use yii\web\NotFoundHttpException;
use \app\modules\app\models\AppDebug;


/**
 * @name App设备管理
 * @panel 1
 */
class DeviceController extends AdminController
{
    /**
     * @name 安装设备记录
     * @menu true
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



}


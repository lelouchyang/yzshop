<?php
namespace app\modules\test\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;

/**
 * @name 后台测试
 */
class SiteController extends AdminController
{


    public $enableCsrfValidation = false;
    
    /**
     * @name 临时测试
     * @menu true
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}

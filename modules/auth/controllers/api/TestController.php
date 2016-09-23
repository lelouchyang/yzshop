<?php
namespace app\modules\auth\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\mysite\models\AuthUser;

/**
 * @name 用户相关API
 */
class TestController extends ApiController
{
    
    public function actionT1()
    {

        $this->params;

        // -----
        //
        //
        // -----


        $this->datas = [
            'name' => 'abc'
        ];
    }

}


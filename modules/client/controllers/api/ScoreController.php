<?php
namespace app\modules\client\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;

/**
 * @name 评分相关Api
 */
class ScoreController extends ApiController
{

    /**
     * @name 店铺列表
     */
    public function actionAdd()
    {
        try {
        
        } catch (\Exception $e) {
            $this->datas['error'] = 1;
            $this->datas['msg'] = $e->getMessage();
        }
    }


}

<?php
namespace app\modules\yz\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\yz\models\YzHospital;
use \app\mysite\helpers\ArrayHelper;

/**
 * @name 医疗平台医院相关控制器
 */
class HospitalController extends ApiController
{

    /**
     * @name 医院列表
     */
    public function actionEntry()
    {
        $longitude = $this->fetchParams('longitude', null);
        $latitude    = $this->fetchParams('latitude', null);

        $hospitals = YzHospital::getList($longitude, $latitude);

        $this->datas = [
            'hostpitals' => $hospitals
        ];
    }

}

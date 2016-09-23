<?php
namespace app\modules\app\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\app\models\AppVersion;
use \app\modules\app\models\AppDevice;
use \app\modules\app\models\AppDebug;

/**
 * @name App相关控制器
 */
class DeviceController extends ApiController
{

    /**
     * @name 设备信息记录
     */
    public function actionIndex()
    {
        $Device = new AppDevice();
        $Device->setAttributes($this->params, false);
        $Device->insert();
        $this->datas['success'] = 1;
    }


}

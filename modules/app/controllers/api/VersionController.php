<?php
namespace app\modules\app\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\app\models\AppVersion;
use \app\modules\app\models\AppDevice;
use \app\modules\app\models\AppDebug;

/**
 * @name 版本管理
 */
class VersionController extends ApiController
{

    /**
     * @name 获取版本信息
     */
    public function actionIndex()
    {
        $versionCode = $this->fetchParams('version_code');

        if ( !$versionCode ) 
        {
            throw new \Exception('却少必要参数');
        }

        $lastVersion = AppVersion::find()
                            ->where(['=', 'status', 1])
                            ->orderBy('version_code DESC')
                            ->one();

        $this->datas['exits'] = 0;
        $this->datas['downUrl'] = '';

        if ( $lastVersion ) 
        {
            $this->datas['versionInfo'] = $lastVersion;

            if ( $lastVersion->version_code > $versionCode ) 
            {
                $this->datas['exits'] = 1;
                $this->datas['downUrl'] = $lastVersion->downUrl;
            } 
        }

    }

}

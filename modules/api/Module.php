<?php
namespace app\modules\api;
use Yii;

/**
 * @name API模块
 * @category sys
 * @panel 10
 */
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
    }

    public function getApiDoc($type='shop')
    {
        $apiDocPath = implode(DS,[$this->basePath, 'doc', "$type.php"]);
        return require($apiDocPath);
    }

}

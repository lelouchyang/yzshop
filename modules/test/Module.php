<?php
namespace app\modules\test;
use Yii;
use yii\base\BootstrapInterface;

/**
 * @name 测试模块
 * @category sys
 */
class Module extends \yii\base\Module  implements BootstrapInterface
{
    public function init()
    {
        parent::init();
    }

    public function bootstrap($app)
    {
        die($app);
    }

}


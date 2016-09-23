<?php
namespace app\commands;

use yii\console\Controller;

/**
 * media文件管理
 */
class MediaController extends Controller
{
    public function actionIndex($action, $target)
    {
        var_dump([$action, $target]);
    }
}

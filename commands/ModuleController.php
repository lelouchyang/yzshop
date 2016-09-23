<?php
namespace app\commands;

use yii\console\Controller;

/**
 * 模块管理
 */
class ModuleController extends Controller
{
    
    /**
     * 列出所有的模块
     */
    public function actionIndex()
    {
        var_dump([$action, $target]);
    }

    /**
     * 模块初始化
     */
    public function actionInit()
    {
    
    }

    /**
     * 列出所有的media文件
     */
    public function actionMedia()
    {
    
    
    }

}

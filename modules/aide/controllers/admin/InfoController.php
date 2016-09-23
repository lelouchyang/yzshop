<?php
namespace app\modules\aide\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;

/**
 * @name 系统信息
 * @panel 10
 */
class InfoController extends AdminController
{

    /**
     * @name PHP信息
     * @menu true
     */
    public function actionPhp()
    {
        phpinfo();
    }

    /**
     * @name 数据库信息
     * @menu true
     */
    public function actionDatabase()
    {
        $db = $this->request->get('db', 'db');

        // TODO 暂时 修改完善
        if ( $db == 'db' ) {
            $dbName = 'yzshop';
        } else {
            $dbName = 'yunzhi120';
        }

        $datas = [
            'db' => $db,
            'dbName' => $dbName
        ];

        return $this->render('database', $datas);
    }

}


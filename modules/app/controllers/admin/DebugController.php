<?php
namespace app\modules\app\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use yii\web\NotFoundHttpException;
use \app\modules\app\models\AppDebug;


/**
 * @name App Debug控制器
 * @panel 1
 */
class DebugController extends AdminController
{
    /**
     * @name Debug消息列表
     * @menu true
     */
    public function actionIndex()
    {
        $datas = AppDebug::find()
            ->orderBy('created desc')
            ->pagination();

        $this->view->title = "Debug信息列表";
        return $this->render('index', $datas);
    }

    /**
     * @name Debug信息详情
     */
    public function actionInfo()
    {
        $id = $this->request->get('id');
        $appDebug = AppDebug::findOne($id);
        return $this->renderPartial('info', [
            'appDebug'=>$appDebug
        ]);
    }


}


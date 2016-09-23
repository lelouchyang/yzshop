<?php
namespace app\modules\app\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use yii\web\NotFoundHttpException;
use \app\modules\app\models\AppPush;


/**
 * @name App推送信息管理
 * @panel 1
 */
class PushController extends AdminController
{
    /**
     * @name 推送消息列表
     * @menu true
     */
    public function actionIndex()
    {
        $datas = AppPush::find()
            ->orderBy('created desc')
            ->pagination();
        $this->view->title = "App推送信息管理";
        return $this->render('index', $datas);
    }


    public function actionInfo()
    {
        $id = $this->request->get('id');
        $appPush = AppPush::findOne($id);
        return $this->renderPartial('info', [
            'appPush'=>$appPush
        ]);
    }

    /**
     * @name 推送消息详情
     * @menu true
     */

    /**
     * @name 删除版本
     */
    public function actionDel()
    {
        $id = $this->request->get('id');
        $appPush = AppPush::findOne($id);
        $appPush->status = 0;
        $appPush->save();
        return $this->json([
            'datas'  => null,
            'msg'    => '删除成功',
            'status' => 1
        ]);

    }

}

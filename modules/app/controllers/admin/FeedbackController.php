<?php
namespace app\modules\app\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use yii\web\NotFoundHttpException;
use \app\modules\app\models\AppFeedback;



/**
 * @name 商户反馈管理
 * @panel 1
 */
class FeedbackController extends AdminController
{
    /**
     * @name 反馈信息列表
     * @menu true
     */
    public function actionIndex()
    {
    	$datas = AppFeedback::find()
            ->orderBy('app_feedback.created desc')
            ->where('app_feedback.status > 0')
            ->joinWith('shop')
            ->pagination();
        
        $this->view->title = "反馈信息管理";
        return $this->render('index', $datas);
    }

    /**
     * @name 反馈信息详情
     */
    public function actionInfo()
    {
        $id = $this->request->get('id');
        $appFeedback = AppFeedback::findOne($id);
        return $this->renderPartial('info', [
            'appFeedback'=>$appFeedback
        ]);
    }


    /**
     * @name 推送信息
     */
    public function actionEdit()
    {
        $action = $this->request->get('action');
        if ( !in_array($action, ['add', 'update']) ) {
            http404();
        }

        return $this->$action();
    }


    /**
     * @name 编辑店铺类型
     */
    protected function update()
    {
        if ( $this->request->isPost ) {
            $id = $this->request->post('id');
            $appFeedback = AppFeedback::findOne($id);
            $appFeedback->content = $this->request->post('content');
            $appFeedback->save();
            return $this->json([
                'datas' => null,
                'msg' => '更新成功',
                'status' => 1
            ]);
        }
        $id = $this->request->get('id');
        $appFeedback = AppFeedback::findOne($id);
        return $this->renderPartial('edit', [
            'appFeedback' => $appFeedback
        ]);
    }

    /**
     * @name 删除推送信息
     */
    public function actionDel()
    {
        $id = $this->request->get('id');
        $appFeedback = AppFeedback::findOne($id);
        $appFeedback->status = 0;
        $appFeedback->save();
        return $this->json([
            'datas'  => null,
            'msg'    => '删除成功',
            'status' => 1
        ]);

    }

}

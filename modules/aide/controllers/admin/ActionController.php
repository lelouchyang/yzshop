<?php
namespace app\modules\aide\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use \app\mysite\helpers\ActionHelper;
use \app\mysite\helpers\Url;
use \app\mysite\models\SysAction;

/**
 * @name 控制器管理
 * @panel 10
 */
class ActionController extends AdminController
{

    /**
     * @name 控制器管理
     * @menu true
     */
    public function actionIndex()
    {
        $actions = SysAction::find()
                 ->orderBy( ['path' => SORT_ASC] )
                 ->all();

        $datas = [
            'actions' => $actions,
        ];
        return $this->render('index', $datas);
    
    }

    /**
     * @name 控制器初始化
     */
    public function actionInit()
    {
        ActionHelper::init();
        $this->redirect(Url::to(['/aide/admin/action']));
    }

    /**
     * @name 控制器编辑
     */
    public function actionEdit()
    {
        if ( $this->Request->isPost ) {
            $id = $this->Request->post('id');
            $custom_name = $this->Request->post('custom_name');
            $custom_des = $this->Request->post('custom_des');

            $record = SysAction::findOne($id);
            if ( $custom_name ) {
                $record->custom_name = $custom_name;
            }
            if ( $custom_des ) {
                $record->custom_des = $custom_des;
            }
            $record->save();

            $this->redirect(Url::to(['/aide/admin/action']));
            return;

        }

        $id = $this->Request->get();

        $record = SysAction::findOne($id);

        if ($record === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('edit', ['record' => $record]);
    }



}


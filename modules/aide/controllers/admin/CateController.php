<?php
namespace app\modules\aide\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use \app\mysite\helpers\ActionHelper;
use \app\mysite\models\SysAction;
use \app\mysite\models\SysCategory;
use yii\web\NotFoundHttpException;


/**
 * @name 系统分类管理
 * @panel 10
 */
class CateController extends AdminController
{
    /**
     * @name 系统分类管理
     * @menu true
     */
    public function actionIndex()
    {
        $cateList = SysCategory::find()
                        ->where(['status' => 1])
                        ->orderBy('path')
                        ->all();

        $this->view->title = "分类管理";
        return $this->render('index', [
            'cateList' => $cateList
        ]);
    }

    /**
     * @name 添加/编辑分类
     */
    public function actionEdit()
    {
        $actions = ['add', 'edit'];
        $action = $this->request->get('action', 'add');
        if ( !in_array($action, $actions) ) {
            throw new \yii\web\NotFoundHttpException;
        }
        return $this->$action();
    }

    protected function add()
    {
        
        if ( $this->request->isPost ) {
            $post = $this->request->post(); 
            $cate = new SysCategory();
            $cate->setAttributes($post, false);
            $cate->save();
            return $this->json([
                'msg' => '保存成功',
                'status' => 1
            ]);
        }

        $pid = $this->request->get('pid', 0);
        $category = NULL; 
        if ( $pid && !$category = SysCategory::findOne($pid) ) {
            throw new \yii\web\NotFoundHttpException;
        }
        $datas = [
            'pid'      => $pid,
            'category' => $category
        ];
        $this->view->title = "添加分类";
        return $this->renderPartial('add', $datas);
    }

    protected function edit()
    {
    
    }
    
    /**
     * @name 删除分类
     */
    public function actionDelete()
    {
        $id = $this->request->get('id');
        $cate = SysCategory::findOne($id);
        if ( $cate->hasChild() ) {
            return $this->json([
                'msg' => '改分类下还有子分类',
                'status' => 0
            ]);
        }
        $cate->delete();
        return $this->json([
            'msg' => '删除成功',
            'status' => 1
        ]);
    
    }



}


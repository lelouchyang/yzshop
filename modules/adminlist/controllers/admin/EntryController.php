<?php
namespace app\modules\adminlist\controllers\admin;

use Yii;
use app\mysite\web\AdminController;
use app\modules\adminlist\models\YzLiaoningkq;


/**
 * @name 录取名单
 * @panel 1
 */
class EntryController extends AdminController
{
  /**
   * @name 录取名单
   * @menu true
   */
   public function actionIndex()
   {

        $datas = YzLiaoningkq::find()
            ->orderBy('created desc')
            ->where('status = 1')
            ->pagination();
            print_r(json_encode($datas));
            die();
        $this->view->title = "录取名单";
        return $this->render('index', $datas);
    }


    

    /**
     * @name 添加/编辑评论
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
     * 编辑评论
     */
    protected function update()
    {
        if ( $this->request->isPost ) {
            $id = $this->request->post('id');
            $data = YzLiaoningkq::findOne($id);
            $data->number = $this->request->post('number');
            $data->name = $this->request->post('name');
            $data->sex = $this->request->post('sex');
            $data->department = $this->request->post('department');
            $data->save();
            return $this->json([
                'datas' => null,
                'msg' => '更新成功',
                'status' => 1
            ]);
        }
        $id = $this->request->get('id');
        $data = YzLiaoningkq::findOne($id);
        return $this->renderPartial('edit', [
            'data' => $data
        ]);
    }

    /**
     * @name 录取名单添加
     */
    protected function add()
    {
        $this->view->title = "录取名单添加";
        if ( $this->Request->isPost ) 
        {
            $post = $this->request->post();
            
                $version = new YzLiaoningkq();
                $version->number = $post['number'];
                $version->name = $post['name'];
                $version->sex      = $post['sex'];
                $version->department = $post['department'];
                $version->save();
            
        }


        return $this->render('add', [
            
        ]);
    }



    /**
     * @name 删除版本
     */
    public function actionDel()
    {
        $id = $this->request->get('id');
        $data = YzLiaoningkq::findOne($id);
        $data->status = 0;
        $data->save();
        return $this->json([
            'datas'  => null,
            'msg'    => '删除成功',
            'status' => 1
        ]);
        
    }

}





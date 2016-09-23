<?php
namespace app\modules\report\controllers\admin;

use Yii;
use app\mysite\web\AdminController;
use app\mysite\widgets\editor\Ueditor;
use app\modules\report\models\YzKouqianggg;


/**
 * @name 文档编辑
 * @panel 1
 */
class EntryController extends AdminController
{
  /**
   * @name 进修报告
   * @menu true
   */
   public function actionIndex()
   {
       $id="1";
       $datas = YzKouqianggg::findOne($id); 
        return $this->render('index', [
            'datas' => $datas,
        ]);        
        
    }


    

    /**
     * @name 添加/编辑文章
     */
    public function actionEdit()
    {
        $action = $this->request->get('action');
        if ( !in_array($action, ['add','update']) ) {
            http404();
        }

        

        return $this->$action();
    }

    

    protected function update()
    {

        if ( $this->request->isPost ) 
        {
            $id = $this->request->post('id');
            if ( !$id || !$article=YzKouqianggg::findOne($id)) 
            {
                throw new NotFoundHttpException;
            }
            $post = $this->request->post();
            $article->setAttributes($post, false);
            $article->save();
            $this->redirect("/admin/report/entry/index");
        }

    
        $id = $this->request->get('id');

        $datas = YzKouqianggg::findOne($id);

        $this->view->title = "修改文章";

        return $this->render('edit', [
            'datas' => $datas,
        ]);
    
    }

    

}





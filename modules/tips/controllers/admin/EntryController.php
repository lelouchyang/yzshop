<?php
namespace app\modules\tips\controllers\admin;

use Yii;
use app\mysite\web\AdminController;

use app\modules\tips\models\YzLiaoningkqbz;


/**
 * @name 备注信息
 * @panel 1
 */
class EntryController extends AdminController
{
  /**
   * @name 备注修改
   * @menu true
   */
   public function actionIndex()
   {

                
       $id="1";
       $datas = YzLiaoningkqbz::findOne($id); 
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
            if ( !$id || !$article=YzLiaoningkqbz::findOne($id)) 
            {
                throw new NotFoundHttpException;
            }
            $post = $this->request->post();
            $article->text = $this->request->post('text');
            $article->setAttributes($post, false);
            $article->save();
            $this->redirect("/admin/tips/entry/index");
            
        }

    
        $id = $this->request->get('id');

        $datas = YzLiaoningkqbz::findOne($id);

        $this->view->title = "修改备注";

        return $this->render('edit', [
            'datas' => $datas,
        ]);
    
    }

    

}





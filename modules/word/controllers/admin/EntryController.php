<?php
namespace app\modules\word\controllers\admin;

use Yii;
use app\mysite\web\AdminController;
use app\modules\word\models\YzKouqiangwd;
use app\modules\word\models\FileUpload;



/**
 * @name 表格管理
 * @panel 1
 */
class EntryController extends AdminController
{
  /**
   * @name 表格列表
   * @menu true
   */
   public function actionIndex()
   {

        $datas = YzKouqiangwd::find()
            ->orderBy('created desc')
            //->where('status = 1')
            ->pagination();
         
        $this->view->title = " 表格列表";
        return $this->render('index', $datas);
    }

     
     /**
     * @name 编辑上传文件
     */
    public function actionEdit()
    {
        $action = $this->request->get('action');
        if ( !in_array($action, ['add', 'update']) ) {
            http404();
        }

        return $this->$action();
    }
     
     
     protected function update()
    {

        $id = $this->request->get('id');

        $article = YzKouqiangwd::findOne($id);

        $this->view->title = "编辑文件";

        return $this->render('add', [
            'article' => $article, 
        ]);
    
    }


    protected function add()
    {


        return $this->render('add'
        );
    
    }

    public function actionTest()
    {

        $s=fopen("images/liyang.doc","r");
        
    
    }

    /**
     * @name 删除版本 test.yunzhi120.com/upload/liyang.doc
     */
    public function actionPreview()
    {
        header('Content-type:application/msword');
        $fp=fopen("test.yunzhi120.com/upload/liyang.doc",r);
        $file=file($fp);
        
        foreach($file as $k=>$v){
        echo $v;
        } 
        
    }

   public function actionUpload(){  
        
        $up = new FileUpload;
        //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
        $up -> set("path", "./images/");
        $up -> set("maxsize", 2000000);
        $up -> set("allowtype", array("pdf"));
        $up -> set("israndname", false);
 
    //使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 pic, 如果成功返回true, 失败返回false
    if($up -> upload("pic")) {
        $id = $this->request->get('id');
        $name = $this->request->post('name');
        $article = YzKouqiangwd::find()->where(['id'=>$id])->one();
        $filename = $up->getFileName()['0'];
        $article->url="./images/".$filename;
        $article->name=$name;
        $result=$article->save();
        if($result){
        $this->redirect('/admin/word/entry/index.html');
        }
    } else {
        $id = $this->request->get('id');
        $name = $this->request->post('name');
        $article = YzKouqiangwd::find()->where(['id'=>$id])->one();
        $article->name=$name;
        $result=$article->save();
        if($result){
        $this->redirect('/admin/word/entry/index.html');
        }
        //echo '<pre>';
        //获取上传失败以后的错误提示
        //var_dump($up->getErrorMsg());
        //echo '</pre>';
    }
   }
}





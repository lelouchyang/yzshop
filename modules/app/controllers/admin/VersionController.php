<?php
namespace app\modules\app\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use yii\web\NotFoundHttpException;
use \app\modules\app\models\AppVersion;
use \yii\web\UploadedFile;


/**
 * @name app版本信息管理
 * @panel 1
 */
class VersionController extends AdminController
{
    /**
     * @name 版本信息管理
     * @menu true
     */
    public function actionIndex()
    {

        $datas = AppVersion::find()
            ->where(['status'=>1])
            ->pagination();

        $this->view->title = "APP版本管理";
        return $this->render('index', $datas);
    }

    /**
     * @name 添加/编辑app版本信息
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
     * @name 版本添加
     */
    protected function add()
    {
        $this->view->title = "app版本信息添加";
        $error_info = [];

        if ( $this->Request->isPost ) 
        {
            $post = $this->request->post();
            $filePath = $this->processUpload();

            $androidUrl = Yii::getAlias('@appSoftUrl').$filePath;

            $record = AppVersion::findOne(['status'=>1, 'version_code'=>$post['version_code']]);
            if ( $record ) {
                $error_info['version_code'] = '版本号重复';
            } else {
                $version = new AppVersion();
                $version->version_code = $post['version_code'];
                $version->version_name = $post['version_name'];
                $version->content      = $post['content'];
                $version->is_published = $post['is_published'];
                $version->android_url  = $this->request->post('android_url', $androidUrl);
                $version->ios_url      = $post['ios_url'];
                $version->file_path    = $filePath;
                $info = $version->save();
                $this->redirect('/admin/app/version.html');
            }
        }

        $version = new AppVersion();
        $version->loadDefaultValues();
        $this->view->title = "添加APP版本";

        return $this->render('edit', [
            'version'    => $version, 
            'error_info' => $error_info
        ]);
    }


    /**
     * 编辑版本信息
     */
    protected function update()
    {
        if ( $this->request->isPost ) {

            $id = $this->request->post('id');
            $post = $this->request->post();
            $version = AppVersion::findOne($id);

            $filePath = $this->processUpload();

            $version->version_code = $post['version_code'];
            $version->version_name = $post['version_name'];
            $version->content      = $post['content'];
            $version->is_published = $post['is_published'];
            $version->ios_url      = $post['ios_url'];
        
            if ( $filePath ) {
                $version->file_path    = $filePath;
                $androidUrl = Yii::getAlias('@appSoftUrl').$filePath;
                $version->android_url  = $this->request->post('android_url', $androidUrl);
            } else {
                $version->android_url  = $post['android_url'];
            }


            $version->save();

            $this->redirect('/admin/app/version.html');
        }
        $id = $this->request->get('id');
        $version = AppVersion::findOne($id);
        $this->view->title = "修改APP版本";
        return $this->render('edit', [ 'version' => $version ]);
    }

    /**
     * 上传处理
     */
    protected function processUpload()
    {
        $apk = UploadedFile::getInstanceByName('apk');

        if ( !$apk ) {
            return '';
        }

        $ext = strtolower(pathinfo($apk->name, PATHINFO_EXTENSION));

        $newFilename = implode('/', [
            Yii::getAlias('@appSoftPath'),
            time().'.'.$ext 
        ]);

        $mts = (string)microtime(true);
        $mts = str_replace('.','_',$mts);

        $appSoftPath = Yii::getAlias('@appSoftPath');
        $newFileName = $appSoftPath. '/' . $mts .'.'.$ext;
        $apk->saveAs($newFileName);

        $filePath = trim(substr($newFileName, strlen($appSoftPath)), '/');

        return $filePath;
    }




    /**
     * @name 删除版本
     */
    public function actionDel()
    {
        $id = $this->request->get('id');
        $version = AppVersion::findOne($id);
        $version->status = 0;
        $version->save();
        return $this->json([
            'datas'  => null,
            'msg'    => '删除成功',
            'status' => 1
        ]);

    }

}


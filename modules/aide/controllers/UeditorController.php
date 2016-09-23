<?php
namespace app\modules\aide\controllers;

use Yii;
use \app\mysite\web\BootController;

/**
 * @name ueditor编辑器辅助控制器
 */
class UeditorController extends BootController
{

    /**
     * @name 入口管理
     */
    public function actionIndex()
    {
        $action = $this->request->get('action');
        return $this->$action();
    }

    protected function config()
    {
        return $this->json(Yii::$app->params['ueditor']);
    }

    protected function upload()
    {
        $size = $this->request->get('size','big');

        $uploader = \app\mysite\web\Upload::process('upfile', 'editor');

        $datas = [
            "state"    => "SUCCESS",
            "url"      => $uploader->getImageUrl($size),
            "title"    => '',
            "original" => '',
            "type"     => '',
            "size"     => ''
        ];
        return $this->json($datas);
    }

}


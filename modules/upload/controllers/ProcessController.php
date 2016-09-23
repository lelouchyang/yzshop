<?php
namespace app\modules\upload\controllers;

use Yii;
use \app\mysite\web\BootController;
use \app\mysite\web\Upload;
use \app\mysite\models\SysAffix;

/**
 * @name 上传处理控制器
 */
class ProcessController extends BootController
{

    public $enableCsrfValidation = false;

    /**
     * @name 百度图片上传处理
     */
    public function actionImage()
    {

        $resName   = $this->request->get('res_name');
        $thumbConf = $this->request->get('thumb_conf');

        $uploader  = Upload::process('uploaderFile', $thumbConf, true);

        $retval = [
            'msg'    => '上传失败',
            'status' => 1
        ];

        if ( $uploader->affix ) {
            $retval = [
                'id'     => $uploader->affix->id,
                'msg'    => 'ok',
                'status' => 1
            ];
        } 

        return $this->json($retval);
    }

}

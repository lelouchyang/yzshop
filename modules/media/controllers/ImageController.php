<?php
namespace app\modules\media\controllers;

use Yii;
use \app\mysite\web\BootController;
use \yii\web\NotFoundHttpException;
use yii\web\Response;
use dosamigos\qrcode\QrCode;

/**
 * @name 图片控制器
 */
class ImageController extends BootController
{

    /**
     * @name 验证码
     */
    public function actionCaptcha()
    {
        return (new \app\mysite\captcha\CaptchaAction('index', $this))->run();
    }

    /**
     * @name 显示模块下media文件
     */
    public function actionModule($module, $path)
    {
        if ( $module == 'libs') 
        {
            $realPath = implode(DS, [
                Yii::getAlias('@app/mysite'),
                'assets',
                'libs',
                $path
            ]);
        } else 
        {
            $realPath = implode(DS, [
                Yii::getAlias('@app/modules'),
                $module,
                'media',
                $module,
                $path
            ]);
        }

        
        if ( !file_exists($realPath) ) 
        {
            throw new NotFoundHttpException($realPath);
        }

        $mimeType =\app\mysite\helpers\FileHelper::getMimeTypeByExtension($realPath);


        Yii::$app->getResponse()->getHeaders()
            ->set('Pragma', 'public')
            ->set('Expires', '360000')
            ->set('Content-type', $mimeType);

        Yii::$app->response->format = Response::FORMAT_RAW;

        return file_get_contents($realPath);
    }
}

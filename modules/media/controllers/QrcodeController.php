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
class QrcodeController extends BootController
{

    /**
     * @name 验证码
     */
    public function actionGen()
    {
        $req  = Yii::$app->request;
        $resp = Yii::$app->response;

        $text   = $req->get('text', 'isme.sun@createunion');
        $level  = $req->get('level', 3);
        $size   = $req->get('size', 10);
        $margin = $req->get('margin', 2);

        $filename = md5(implode('', [
            $text, $level, $size, $margin
        ])).'.png';

        $realFilename = Yii::getAlias('@mediaPath').DS.'qrcode'.DS.$filename;
        $url = Yii::getAlias('@mediaUrl').'/qrcode/'.$filename;

        if ( !file_exists($realFilename) ) 
        {
            QrCode::png($text, $realFilename, $level, $size, $margin);
        }

        $resp->headers->set('Content-Type', 'text/plain');

        return $url;
    }

}

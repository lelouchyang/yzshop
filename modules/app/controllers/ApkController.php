<?php
namespace app\modules\app\controllers;

use Yii;
use \app\mysite\web\HomeController;
use yii\web\NotFoundHttpException;
use app\modules\app\models\AppVersion;
use app\modules\app\models\AppDown;
use dosamigos\qrcode\QrCode;  
use dosamigos\qrcode\lib\Enum;
use yii\web\Response;


/**
 * @name Apk包管理器
 * @panel 1
 */
class ApkController extends HomeController
{

    /**
     * 版本二维码
     */ 
    public function actionQrcode() 
    { 
        $id = $this->request->get('id');
        if ( !$id ) 
        {
            http404();
        }

        $Version = AppVersion::findOne($id);
        if ( !$Version ) 
        {
            http404();
        }

        Yii::$app->getResponse()->getHeaders()
                 ->set('Content-type', 'image/png');

        Yii::$app->response->format = Response::FORMAT_RAW;


        return QrCode::png( $Version->weiXinDownUrl,
            false, Enum::QR_ECLEVEL_L, 6
        );
    }

    /**
     * @name 下载apk
     */
    public function actionDown()
    {
        $f = $this->request->get('f');
        
        $Version = AppVersion::find()
                        ->where(['file_path'=>$f, 'status'=>1, 'is_published'=>1])
                        ->one();

        $appSoftPath = Yii::getAlias('@appSoftPath').'/'.$f;

        if ( !$Version || !file_exists($appSoftPath) ) 
        {
            http404();
        }
    
        // 开启事务
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $Version->down_count = $Version->down_count + 1;
            $Version->save();

            $Down = new AppDown();

            $Down->ip    = $this->request->userIp;
            $Down->agent = $this->request->userAgent? $this->request->userAgent : '';
            $Down->version_id = $Version->id;
            $Down->save();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            // 无论成不成功都允许下载 TODO log
        }

        return Yii::$app->response->sendFile($appSoftPath);
    }

    /**
     * 下载最新的版本
     */
    public function actionDownLatest()
    {
        $Version = AppVersion::find()
                     ->where(['status'=>1, 'is_published'=>1])
                     ->orderBy('version_code desc')
                     ->one();
        if ( !$Version ) 
        {
            http404(); 
        }
    
        $appSoftPath = Yii::getAlias('@appSoftPath').'/'.$Version['file_path'];
        if ( !file_exists($appSoftPath ) ) 
        {
            http404();
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $Version->down_count = $Version->down_count + 1;
            $Version->save();

            $Down = new AppDown();

            $Down->ip    = $this->request->userIp;
            $Down->agent = $this->request->userAgent? $this->request->userAgent : '';
            $Down->version_id = $Version->id;
            $Down->save();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            // 无论成不成功都允许下载 TODO log
        }

        return Yii::$app->response->sendFile($appSoftPath);
    }


    /**
     * 最新版本二维码
     */ 
    public function actionQrcodeDownLatest() 
    { 

        Yii::$app->getResponse()->getHeaders()
                 ->set('Content-type', 'image/png');

        Yii::$app->response->format = Response::FORMAT_RAW;


        $url = WEB_ROOT.'/app/apk/down-latest';

        return QrCode::png( $url,
            false, Enum::QR_ECLEVEL_L, 6
        );

    }


}



<?php
namespace app\modules\upload\controllers;

use Yii;
use \yii\web\Controller;
use \app\mysite\web\Upload;
use \app\mysite\helpers\Thumb;
use yii\web\Response;

/**
 * @name 动态缩略图控制器
 */
class ThumbController extends Controller
{
    /**
     * @name 动态说略图处理
     */
    public function actionProcess($mode, $width, $height,$path)
    {

        $path = Upload::genRealPath(DS.$path);

        if ( !is_file($path) ) {
            throw new NotFoundHttpException;
        } 

        $modes = [
            'auto'  => \app\mysite\image\kohana\Image::AUTO,
            'crop'  => \app\mysite\image\kohana\Image::CROP,
            'adapt' => \app\mysite\image\kohana\Image::ADAPT,
        ];

        $mode = $modes[$mode];

        $img = Thumb::makeModeSize($mode, $width, $height, $path);
        $newFile = Yii::getAlias('@webroot').Yii::$app->request->url;
        $newPath = dirname($newFile);

        if ( !file_exists( $newPath )) 
        {
            mkdir($newPath, 0777, true);
        }

        $img->save($newFile);

        Yii::$app->getResponse()->getHeaders()
            ->set('Content-type', $img->mime);

        Yii::$app->response->format = Response::FORMAT_RAW;

        return $img->render();

    }


}

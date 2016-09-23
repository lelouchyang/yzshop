<?php
namespace app\modules\ui\controllers\admin;

use Yii;
use \app\mysite\models\SysAction;
use \app\mysite\web\AdminController;
use app\mysite\helpers\FileHelper;

/**
 * @name 后台UI演示
 */
class DemoController extends AdminController
{
    /**
     * @name 后台标准列表页面
     * @menu true
     */
    public function actionIndex()
    {
        $actions = SysAction::find()
                 ->orderBy( ['path' => SORT_ASC] )
                 ->limit(10)
                 ->all();

        $datas = [
            'actions' => $actions,
        ];

        return $this->render('index', $datas);
    }

    /**
     * @name PC图标
     * @menu true
     */
    public function actionPcIcon()
    {
        return $this->render('pc-icon');
    }

    /**
     * @name 移动端图标
     * @menu true
     */
    public function actionMobileIcon()
    {
        return $this->render('mobile-icon');
    }

    /**
     * @name 表单演示 
     * @menu true
     */
    public function actionForm()
    {
        return $this->render('form');
    }

    /**
     * @name 色彩演示
     * @menu true
     */
    public function actionColor()
    {
        return $this->render('color');
    }


    /**
     * @name 状态色块(参考)
     * @menu true
     */
    /*
    public function actionBcolor()
    {
        $themes = Yii::getAlias('@app/web/media/images/bgcolor');

        $fileList = FileHelper::findFiles($themes);

        $urls = [];
        foreach( $fileList as $file ) {
            $urls[] = '/media/images/bgcolor/'.substr($file, strlen($themes));  
        }

        return $this->render('bcolor', ['urls'=>$urls]);
    }*/
}

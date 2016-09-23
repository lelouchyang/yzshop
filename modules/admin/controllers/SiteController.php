<?php
namespace app\modules\admin\controllers;

use Yii;
use \app\mysite\helpers\Url;
use \app\mysite\web\AdminController;
/**
 * @name 后台控制器
 */
class SiteController extends AdminController
{

    /**
     * @name 后台首页入口
     */
    public function actionIndex()
    {
        

        return $this->render('index');
    }

    /**
     * @name 后台登陆
     */
    public function actionLogin()
    {
        $auth = Yii::$app->auth;

        if ( $auth->isStaff ) 
        {
            $this->redirect(Url::home());
        } 
        else 
        {
            $errorMsg = [];
            if ( $this->request->isPost ) {
                $username = $this->request->post('username');
                $password = $this->request->post('password');
				
				//$validCode = $this->request->post('captcha_validcode');

                try {
                    
                    $auth->userLogin($username, $password);
                    if ( $auth->isStaff ) {
                        $this->redirect(Url::home());
                    } else {
                        throw new \Exception("没有后台登陆权限");
                    }

                } catch (\Exception $e) {
                    $errorMsg[] = $e->getMessage();
                }
            }
            return $this->renderPartial('login', ['errorMsg'=>$errorMsg]);
        }

    }

    /**
     * @name 后台登出
     */
    public function actionLogout()
    {
        $auth = Yii::$app->auth;
        $auth->logout();
        $this->redirect(Url::to(['login']));
    }

}


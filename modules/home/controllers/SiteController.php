<?php
namespace app\modules\home\controllers;

use Yii;
use \app\mysite\web\HomeController;
use \app\mysite\models\AuthUser;
use \app\mysite\helpers\Url;
use \app\modules\app\models\AppVersion;
use \app\mysite\Auth;

/***
 * @name 前台入口
 */
class SiteController extends HomeController
{

    /**
     * @name 前台首页
     */
    public function actionIndex()
    {
        
        
        return $this->render('index');
    }

    /**
     * @name 前台用户注册
     */
    public function actionRegister()
    {
        $user = new AuthUser();

        if ( $this->request->isPost ) 
        {

            # TODO Yii 验证
            $username = $this->request->post('username');

            $password = $this->request->post('password');
            $repassword = $this->request->post('repassword');

            $errors = [];
            if ( $password != $repassword ) 
            {
                $errors['repassword'] = '两次输入密码不一致';
            } 

            if ( strlen($password) < 6 ) 
            {
                $errors['password'] = '密码长度不能小于6';
            }

            if ( !AuthUser::isUnique($username, 'username') )
            {
                $errors['username'] = '用户已经存在';
            }

            if ( empty($errors) ) 
            {
                $user->username = $username;
                $user->password = Auth::hash($password);
                $user->save();
                Yii::$app->auth->login($user);
                $this->redirect(Url::to(['/']));
            }
        }

        $user = new AuthUser();
        $user->loadDefaultValues();

        $datas = [
            'user' => $user,
        ];

        return $this->render('register', $datas);
    }

    /**
     * @name 前台登陆
     */
    public function actionLogin()
    {
        if ( Yii::$app->auth->user ) 
        {
            $this->redirect(Url::to(['/']));
        }

        if ( $this->request->isPost ) 
        {
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            Yii::$app->auth->userLogin($username, $password);
            if ( Yii::$app->user ) 
            {
                $this->redirect(Url::to(['/index.php']));
            } 
        }
        return $this->render('login');
    }

    /**
     * @name 后台登陆
     */
    public function actionLogout()
    {
        $auth = Yii::$app->auth;
        $auth->logout();
        $this->redirect(Url::to(['/']));
    }

    /**
     * @name 用户协议
     */
    public function actionAgreement()
    {
        return $this->renderPartial('agreement');
    }

    /**
     * @name 项目说明文档
     */
    public function actionDoc()
    {
        return $this->render('doc');
    }
}

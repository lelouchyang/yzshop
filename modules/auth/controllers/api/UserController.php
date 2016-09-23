<?php
namespace app\modules\auth\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\mysite\models\AuthUser;
use \app\modules\app\helpers\AppUpload;

/**
 * @name 用户相关API
 */
class UserController extends ApiController
{

    /**
     * @name 检查一个手机号码时候存在
     */
    public function actionCheckMobile()
    {
        $mobile = $this->fetchParams('mobile');
        // TODO 手机号码验证
        if ( !$mobile )
        {
            throw new \Exception('非法的手机号码');
        } 
        $this->datas['exist'] = (int)! AuthUser::isUnique($mobile,'mobile');
    }

    /**
     * @name 用户获取验证码
     */
    public function actionValidCode()
    {
        $mobile = $this->fetchParams('mobile');
        // TODO 手机号码验证
        if ( !$mobile)
        {
            throw new \Exception('非法的手机号码');
        }

        list($validCode, $expire) = AuthUser::genValidCode($mobile);
        // 验证码
        $this->datas['validCode'] = $validCode;
        // 过期时间
        $this->datas['expire'] = $expire;
    }

    /**
     * @name 用户注册
     */
    public function actionRegister()
    {
        $mobile      = $this->fetchParams('mobile');
        $validCode   = $this->fetchParams('valid_code');
        $shopTypeId  = $this->fetchParams('shop_type_id');
        $hospitalIds = $this->fetchParams('hospital_ids');
        $tagIds      = $this->fetchParams('tag_ids');
        $channelId   = $this->fetchParams('channel_id');

        if ( !$mobile || !$validCode )
        {
            throw new \Exception('参数错误');
        }

        # 1 检查手机验证码
        if ( ! AuthUser::checkValidCode($mobile, $validCode) ) 
        {
            throw  new \Exception('手机验证码过期或者不存在');
        }

        # 1 检查商户类型
        if ( ! $shopTypeId ) 
        {
            throw  new \Exception('必须选择商户类型');
        }

        # 2 注册账号
        $retval = AuthUser::shopUserRegister(
                        $mobile, $shopTypeId, $hospitalIds,$channelId, $tagIds);

        list($token, $user, $shop, $hospitals, $tags) = $retval;

        $this->datas['token'] = $token->token;
        $this->datas['expire'] = $token->expire;
        $this->datas += $user->shopAllInfo;

    }

    /**
     * @name 用户登陆
     */
    public function actionLogin()
    {
        $mobile    = $this->fetchParams('mobile');
        $validCode = $this->fetchParams('valid_code');
        $channelId = $this->fetchParams('channel_id');

        if ( !$mobile || !$validCode ) 
        {
            throw new \Exception('参数不完整');
        }

        # 1 检查校验码
        if (!AuthUser::checkValidCode($mobile, $validCode)) 
        {
            throw new \Exception('校验码错误');
        } 
        list($session, $user) = AuthUser::genTokenByMobile($mobile);
        $user->login_channel_id = $channelId;
        $user->save();

        $this->datas['token'] = $session->token;
        $this->datas['expire'] = $session->expire;
        $this->datas += $user->shopAllInfo;

    }

    /**
     * @name 用户退出登陆
     */
    public function actionLogout()
    {
        $this->requireToken();
        AuthUser::removeMobileToken($this->token);
        $this->datas['success'] = 1;
    }

    /**
     * @name 返回用户信息
     */
    public function actionInfo()
    {
        $this->requireToken();

        $this->datas += $this->userInfo->shopAllInfo;
    }

}


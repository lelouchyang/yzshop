<?php
namespace app\modules\api\controllers;
use Yii;
use \app\mysite\helpers\Url;
use \app\mysite\web\BootController;
use \app\mysite\helpers\Base32;
use \app\mysite\helpers\ApiHelper;
use \yii\web\NotFoundHttpException;
use \app\mysite\models\AuthUser;
use \app\modules\shop\models\Shop;

/**
 * API引导控制器
 */
abstract class ApiController extends \yii\rest\Controller
{

    /**
     * 解析后参数
     */
    protected $params = [];

    /**
     * 本次请求token
     */
    protected $token = null;

    /**
     * 当前用户详情
     */
    protected $_userInfo = null;

    /**
     * 当前商城
     */
    protected $_shopInfo = null;

    /**
     * 可覆盖医院信息
     */
    protected $_hospitalInfo = null;

    /**
     * 解析后数据
     */
    protected $datas = 
    [
        'error_code'  => 0,
        'message'     => ''
    ];


    public function runAction($id, $params = [])
    {
        $this->apiInit();
    
        try {
            $result = parent::runAction($id, $params);
            // 防止数组从写
            $this->datas['error_code'] = 0;
            $this->datas['message'] = '';
            // 生产环境去掉
            $this->datas['params'] = $this->params;
            Yii::$app->response->data = $this->datas;
            return $result;
        } catch (\Exception $e) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $this->datas['error_code'] = 1;
            $this->datas['message'] = $e->getMessage();
            // 生产环境去掉
            $this->datas['debug_file'] = $e->getFile();
            $this->datas['debug_line'] = $e->getLine();
            $this->datas['params'] = $this->params;
            Yii::$app->response->data = $this->datas;
        }
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->data = $this->datas;
        return $result;
    }


    /**
     * api 初始化
     */
    protected function apiInit()
    {
        // 公钥 TODO 做成真实授权模式 TODO 整理该方法
        $apiKey = Yii::$app->params['apiKeyList']['apiKey'];
        // 密钥
        $sharedSecret = Yii::$app->params['apiKeyList']['sharedSecret'];
        // --------------------------------------------------------------------
        $req = Yii::$app->request;
        // 合并参数
        $this->params = $req->post() + $req->get();
        // 获取token
        $this->token = isset($this->params['token'])? $this->params['token'] : false;
        unset($this->params['token']);
        // 获取用户apiKey
        $userApiKey = isset($this->params['api_key'])? $this->params['api_key'] : false;
        unset($this->params['api_key']);
        // 获取用户sharedKey
        $userApiSig = isset($this->params['api_sig'])? $this->params['api_sig'] : false;
        unset($this->params['api_sig']);
        if ( !$userApiKey || !$userApiSig ) {
            throw new \Exception('签章错误'); 
        }
        // 计算签章
        if ( !ApiHelper::checkSig($this->params, $sharedSecret, $userApiSig) ) {
            $this->datas['params'] = $this->params;
            return;
            throw new \Exception('签章计算错误'); 
        }

        /*
        foreach( $this->params as $key=>&$value) {
            $value = Base32::decode(strtoupper($value));
        }*/
    }

    protected function fetchParams($name, $default=null)
    {
        $value = arrGetValue($this->params,$name, $default);
        if ( $value === null) return $value;
        return trim($value);
    }

    /**
     * 做token检查，同事获取用户信息
     */ 
    protected function requireToken()
    {
        if ( !$this->token ) 
        {
            throw new \Exception('需求token');
        } else {
            $this->_userInfo = AuthUser::getUserByToken($this->token);
        }
    }

    /**
     * @name 获取当前用户信息
     */
    protected function getUserInfo()
    {
        return $this->_userInfo;

    }

    /**
     * @name 获取当前用户信息
     */
    protected function getShopInfo()
    {
        if ( !$this->_shopInfo ) {
            if ( $this->userInfo ) {
                $this->_shopInfo = $this->userInfo->shop;
            }
        }
        return $this->_shopInfo;
    }

    /**
     * @name 获取当前覆盖医院信息
     */
    protected function getHospitalInfo()
    {
        if ( !$this->_hospitalInfo ) 
        {
            if ( $this->shopInfo ) {
                $this->_hospitalInfo = $this->shopInfo->hospitals;
            }
        }
        return $this->_hospitalInfo;
    }
}

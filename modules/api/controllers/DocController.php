<?php
namespace app\modules\api\controllers;
use Yii;
use \app\mysite\helpers\ApiHelper;
use \app\mysite\helpers\StringHelper;
use \app\mysite\helpers\Base32;
use \app\mysite\web\HomeController;


/**
 * @name Api文档控制器
 */
class DocController extends HomeController
{

    /**
     * 文档首页
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * @name Api文档(商户端)
     */
    public function actionShop()
    {

        $mod = Yii::$app->getModule('api');
        # 1 获取api 文档数组
        $apiDoc = $mod->apiDoc;
        ksort($apiDoc);

        $apiGroup = [];

        foreach($apiDoc as $key=>$info)
        {
            $keyGroup = StringHelper::camelSplit($key);
            $keyName = ucfirst($keyGroup[0]);
            if ( !isset($apiGroup, $keyName) ) 
            {
                $apiGroup[$keyName] = [];
            }
                $apiGroup[$keyName][$key] = $info;
        }

        $datas = [
            'apiDoc' => $apiDoc,
            'apiGroup' => $apiGroup
        ];

        return $this->render('api-base', $datas);
    }

    /**
     * @name Api文档(客户端)
     */
    public function actionClient()
    {

        $mod = Yii::$app->getModule('api');
        # 1 获取api 文档数组
        $apiDoc = $mod->getApiDoc('client');
        
        ksort($apiDoc);

        $apiGroup = [];

        foreach($apiDoc as $key=>$info)
        {
            $keyGroup = StringHelper::camelSplit($key);
            $keyName = ucfirst($keyGroup[0]);
            if ( !isset($apiGroup, $keyName) ) 
            {
                $apiGroup[$keyName] = [];
            }
                $apiGroup[$keyName][$key] = $info;
        }

        $datas = [
            'apiDoc' => $apiDoc,
            'apiGroup' => $apiGroup
        ];

        return $this->render('api-base', $datas);
    }

    /**
     * @name Api文档签章规则
     */
    public function actionSig()
    {
        return $this->render('sig');
    }

    /**
     * @name 数据词典(商户平台)
     */
    public function actionDbshop()
    {
        return $this->render('dbshop');
    }

    /**
     * @name 数据词典(医院平台)
     */
    public function actionDbhospital()
    {
        return $this->render('dbhospital');
    }
    
    /**
     * @name Api 测试控制器
     */
    public function actionTest()
    {

        // 公钥
        $apiKey = Yii::$app->params['apiKeyList']['apiKey'];
        // 密钥
        $sharedSecret = Yii::$app->params['apiKeyList']['sharedSecret'];

        $post = $this->request->post();
        $params = isset($post['params'])? $post['params'] : [];

        // 清理空白当做无
        foreach($params as $k=>$p)
        {
            if ( trim($p) == '' ) {
                unset($params[$k]);
            }
        }

        $token = false;
        if ( isset($params['token']) ) {
            $token = $params['token'];
            unset($params['token']);
        }

        $method = strtolower($post['actionMethod']);
        $url = Yii::$app->params['mainDomain'].$post['actionUrl'];


        // 生成签章
        $apiSig = ApiHelper::makeSig($params, $sharedSecret);

        $datas = [
            'api_key' => $apiKey,
            'api_sig' => $apiSig,
        ];

        foreach($params as $key=>$value) {
            // $datas[$key] = strtolower(Base32::encode($value));
            $datas[$key] = $value;
        }

        if ( $token ) {
            $datas['token'] = $token;
        }

        // --------------------------------------------------------------------
        include(Yii::$app->getVendorPath().'/requests/Requests.php');
        \Requests::register_autoloader();
        $header = [
            'Accept' => 'application/json'
        ];

        if ( $method == 'post') {
            $resp = \Requests::$method($url, $header, $datas);
        } else {
            $url .='?'.http_build_query($datas);
            $resp = \Requests::$method($url, $header);
        }

        $datas = [
            'post'   => $post,
            'params' => $params,
            'resp'   => $resp,
            'datas'  => $datas,
        ];
        return $this->render('test', $datas);
    }

}

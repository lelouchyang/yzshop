<?php
namespace app\modules\app\models;

use Yii;
use app\mysite\db\ActiveRecord;

/**
 * app push 信息
 */
class AppPush extends ActiveRecord 
{

    /**
     * 发送推送信息
     */
    static public function send($channel_id, $message, $option=[], $mobile_type='android')
    {
        if ( $mobile_type == 'android')
        {
            $method = '_sendToAndroid';
        } else {
            $method = '_sendToIOS';
        }
        return self::$method($channel_id, $message, $option );
    }

    /**
     * 发送到安卓
     * $message = ['title'=>'', 'description'=>'','custom_content'=>'']
     */
    static protected function _sendToAndroid($channel_id, $message, $option=[])
    {
        $defaultOption = [
            'msg_type' => 1, // 默认普通消息
        ];

        require_once(Yii::$app->getVendorPath().'/baiduPush/sdk.php');
        $sdk = new \PushSdk();

        
        $option = $option+$defaultOption;
        if ( !isset($message['title']) ) {
            $message['title'] = '云智商户消息提醒';
        }

        $shopId = arrGetValue($option, 'shopId');
        $userId = arrGetValue($option, 'userId');
        $orderId = arrGetValue($option, 'orderId');

        // 入表数据
        $datas = [
            'channel_id'     => $channel_id,
            'mobile_type'    => 'android',
            'msg_type'       => $option['msg_type'],
            'opt'            => json_encode($option),
            'title'          => arrGetValue($message, 'title'),
            'content'        => arrGetValue($message, 'description'),
            'custom_content' => json_encode(arrGetValue($message, 'custom_content', [])),
        ];

        // 发送消息
        $retval = $sdk->pushMsgToSingleDevice($channel_id,$message, $option);

        if ( !$retval ) {
            $datas['error_code'] = $sdk->getLastErrorCode();
            $datas['error_msg'] = $sdk->getLastErrorMsg();
        }  else {
            $datas['msg_id'] = $retval['msg_id'];
            $datas['send_time'] = date('Y-m-d H:i:s',$retval['send_time']);
        }

        $record = new static();
        $record->setAttributes($datas, false);
        $record->insert();

        return $record->id;
    }

    /**
     * 发送到IOS
     */
    static protected function _sendToIOS($channdel_id, $content, $option=[])
    {
        // TODO 
    }

}

<?php
namespace app\modules\app\models;

use Yii;
use app\mysite\db\ActiveRecord;

/**
 * app session 模型
 */
class AppSession extends ActiveRecord 
{
    /**
     * 生成用户token
     * 会删除已经存在的，并且从新生成
     */
    static public function genToken($user, $expireSecond=null)
    {
        if ( !$expireSecond )
        {
            $appExpire = Yii::$app->params['appExpire'];
        }

        # 清除该用户已有session
        static::deleteAll(['user_id' => $user->id]);

        // id + 时间戳 + 随机字符串
        $token = md5(implode('', [$user->id, time(), uniqid()]));

        $session = new static();
        $session->token = $token;
        $session->user_id = $user->id;
        $session->expire = date('Y-m-d H:i:s', time()+$appExpire);
        $session->save();

        return $session;
    
    }
}

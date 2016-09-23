<?php
namespace app\modules\app\models;

use Yii;
use app\mysite\db\ActiveRecord;

/**
 * 版本号模型
 */
class AppVersion extends ActiveRecord 
{

    /**
     * 获取最后的版本
     */
    static public function latest()
    {
    
        $record = AppVersion::find()
                ->where(['status'=>1])
                ->orderBy('version_code desc')
                ->one();

        if ( $record ) {
            $downUrl = $record->downUrl;
            $weiXinDownUrl = $record->weiXinDownUrl;
            $record = $record->toArray();
            $record['down_url'] = $downUrl;
            $record['weixin_down_url'] = $weiXinDownUrl;
            return $record;
        } else {
            return [];
        }

    }

    public function getDownUrl()
    {
        return WEB_ROOT.'/app/apk/down?f='.$this->file_path;
    }

    public function getWeixinDownUrl()
    {
        return WEB_ROOT.'/app/apk/down?f='.$this->file_path.'#mp.weixin.qq.com';
    }
}

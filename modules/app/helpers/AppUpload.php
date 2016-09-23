<?php
namespace app\modules\app\helpers;
use yii;
use \app\mysite\web\Upload;
use \app\mysite\models\SysAffixRel;

class AppUpload 
{

    /**
     * app上传处理附件形式图片
     */
    static public function processAffix($Obj)
    {

        $re = '/^image\_\d+$/';

        $resName = $Obj->resName;
        $resId   = $Obj->id;

        # 1 处理删除
        $photoIds = Yii::$app->request->post('photo_ids',null);
        $coverId  = Yii::$app->request->post('cover_id',null);
        $coverKey = Yii::$app->request->post('cover_key',null);

        if ( $photoIds !== null) 
        {
            $photoIds = array_filter( explode(',', $photoIds) );
            $affix = $Obj->affix;
            $oldPhotoIds = arrGetColumn($affix, 'id');
            // 获取已经删除的
            $delIds = array_diff($oldPhotoIds, $photoIds);

            // 检查被删除的图片是否为封面
            if ( $Obj->hasAttribute('cover') ) 
            {
                foreach($delIds as $delId) {
                    if ( $affix[$delId]['path'] == $Obj->cover) {
                        $Obj->cover = '';
                        $Obj->save();
                        break;
                    }
                }
            }

            $Obj->delAffix($delIds);
        }

        if ( empty($_FILES) ) return;
        $viewOrder = 1;

        # 2 处理新的上传
        foreach($_FILES as $key=>$files) 
        {
            if ( !preg_match($re, $key)) continue;
            $keyArr = explode('_', $key);
            $keyNum = $keyArr[1];

            $uploader = Upload::process($key, $resName, $resId, true);
            $rel = new SysAffixRel();
            $rel->setAttributes([
                'res_id'     => $resId,
                'res_name'   => $resName,
                'affix_id'   => $uploader->affix->id,
                'view_order' => $viewOrder,
            ], false);
            $rel->save();
            $viewOrder++;
            if ( $coverKey == $keyNum ) 
            {
                $coverId = $uploader->affix->id;
            }

        }

        if ( $Obj->hasAttribute('cover') )  {
            if ( $coverId ) {
                $Obj->setCover($coverId);
            } else if ( trim($Obj->cover) == '') {
                $Obj->setCover($coverId);
            }
        }


    }
}


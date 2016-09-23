<?php
namespace app\modules\app\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\app\models\AppFeedback;

/**
 * @name 反馈相关控制器
 */
class FeedbackController extends ApiController
{

    /**
     * @name 添加用户反馈信息
     */
    public function actionAdd()
    {
        $this->requireToken();
        $email = $this->fetchParams('email');
        $content = $this->fetchParams('content');

        if ( !$content ) 
        {
            throw new \Exception('反馈内容不能为空');
        }

        if ( mb_strlen($content, 'utf-8') < 10 ) 
        {
            throw new \Exception('反馈内容不能小于10个字!');
        }

        $datas = [
            'email' => $email,
            'content' => $content,
            'user_id' => $this->userInfo->id,
            'shop_id' => $this->shopInfo->id,
        ];

        $Feedback = new AppFeedback();

        $Feedback->setAttributes($datas, false);
        $Feedback->insert();
        
        $Feedback = AppFeedback::findOne($Feedback->id);

        $this->datas['success'] = 1;
        $this->datas['feedback'] = $Feedback;
    }


}

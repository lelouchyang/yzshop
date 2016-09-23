<?php
namespace app\modules\home\widgets;

use yii;
use yii\base\Widget;

class Nav extends Widget
{
    public function run()
    {
        return $this->render('nav');
    }
}

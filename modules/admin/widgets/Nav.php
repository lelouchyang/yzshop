<?php
namespace app\modules\admin\widgets;

use yii;
use yii\base\Widget;

class Nav extends Widget
{

    public $menus = [];


    public function run()
    {
        $panelId  = Yii::$app->request->get('panel_id',Yii::$app->codename->panelId);
        $moduleId = Yii::$app->request->get('module_id',Yii::$app->codename->moduleId);

        $datas = [
            'currPanelId'  => $panelId,
            'currModuleId' => $moduleId,
            'menus'        => $this->menus
        ];

        return $this->render('nav', $datas);
    }
}

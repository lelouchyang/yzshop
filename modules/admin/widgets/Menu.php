<?php
namespace app\modules\admin\widgets;

use yii;
use yii\base\Widget;
use app\mysite\models\SysMenu;
use app\mysite\helpers\ArrayHelper;

class Menu extends Widget
{
    public $menus = [];

    public function run()
    {
        $app = &Yii::$app;
        $actionId = $app->codename->id;
        $moduleId = $app->request->get('module_id',Yii::$app->codename->moduleId);
        $panelId  =  $app->request->get('panel_id',Yii::$app->codename->panelId);
        // $menus = ArrayHelper::getValue($this->menus[$panelId], 'modules', []);
        $menus = [];
        foreach( $this->menus as $panelId=>$m) {
            if ( array_key_exists('modules', $m)) {
                $menus = array_merge($menus, $m['modules']);
            }
        }

        return $this->render('menu', [
            'menus'    => $menus,
            'actionId' => $actionId,
            'panelId'  => $panelId,
            'moduleId' => $moduleId,
        ]);
    }
}

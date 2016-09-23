<?php
namespace app\modules\m\assets;
use \app\mysite\web\AssetBundle;

class Mobile extends AssetBundle
{
    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $sourcePath = null;

    public $css = [
        '/media/m/style.css',
    ];

    public $js = [
        '/media/m/init.js'
    ];

    public $depends = [
        'app\mysite\assets\Zepto',
        'app\mysite\assets\Ionicons',
        'app\mysite\assets\SuiMobile' 
    ];
}

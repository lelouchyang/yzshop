<?php
namespace app\modules\test\assets;
use \app\mysite\web\AssetBundle;

class Test extends AssetBundle
{
    public $sourcePath = null;

    public $css = [
        '/media/admin/style.css',
    ];

    public $js = [
        '/media/admin/init.js'
    ];

    public $depends = [
        'app\mysite\assets\Jquery',
        'app\mysite\assets\Holder',
        'app\mysite\assets\Fa',
        'app\mysite\assets\SuiPc' 
    ];
}

<?php
namespace app\modules\home\assets;
use \app\mysite\web\AssetBundle;

class Home extends AssetBundle
{
    public $sourcePath = null;

    public $css = [
        '/media/home/style.css',
    ];

    public $js = [
        '/media/home/init.js'
    ];

    public $depends = [
        'app\mysite\assets\Jquery',
        'app\mysite\assets\Holder',
        'app\mysite\assets\Todc',
        'app\mysite\assets\Fa',
    ];

}

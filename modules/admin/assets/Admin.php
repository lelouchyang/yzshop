<?php
namespace app\modules\admin\assets;
use \app\mysite\web\AssetBundle;

class Admin extends AssetBundle
{
    public $sourcePath = null;

    public $css = [
        '/media/admin/style.css',
    ];

    public $js = [
        '/media/admin/init.js'
    ];

    public $depends = [
        'app\mysite\assets\AdminLte',
    ];

}

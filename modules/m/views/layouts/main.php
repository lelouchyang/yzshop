<?php
use yii\helpers\Html;
use \app\mysite\helpers\Url;
use \app\modules\admin\widgets\Menu;
use \app\modules\admin\widgets\Nav;
\app\modules\m\assets\Mobile::register($this);
?>
<?php $this->beginPage() ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的生活</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <?=$this->head();?>
  </head>
  <body>
<?php $this->beginBody() ?>
<?=$content?>
<?php $this->endBody() ?>
  </body>
<!-- 自由输出body bottom -->
<?php if (isset($this->blocks['bottom'])): ?>
   <?= $this->blocks['bottom'] ?>
<?php endif; ?>
<!-- -->
</html>
<?php $this->endPage() ?>

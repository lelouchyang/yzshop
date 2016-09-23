<?php
use yii\helpers\Html;
use \app\mysite\helpers\Url;
\app\modules\m\assets\Mobile::register($this);
?>
<?php $this->beginPage() ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商户工作人员管理后台</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <?=$this->head();?>
  </head>
  <body class="theme-green">

<div class="page-group">
    <div class="page">

        <!-- 标题栏 -->
        <header class="bar bar-nav">
          <a class="icon icon-me pull-left">
            <small><?=Yii::$app->auth->username;?></small>
          </a>
          <h1 class="title">云智商户管理</h1>
        </header>
        <!-- 工具栏 -->
        <nav class="bar bar-tab">

        <a class="tab-item external <?=ifelse(codeName('auth/admin/shop/register'), 'active')?>"
           href="<?=Url::to(['/admin/auth/shop/register'])?>">
            <span class="icon ion-ios-personadd<?=ifelse(!codeName('auth/admin/shop/register'), '-outline')?>"></span>
            <span class="tab-label">商户组册</span>
        </a>
        <a class="tab-item external <?=ifelse(codeName('auth/admin/shop/index'), 'active')?>" 
           href="<?=Url::to(['/admin/auth/shop/index'])?>">
           <span class="icon ion-ios-people<?=ifelse(!codeName('auth/admin/shop/index'), '-outline')?>"></span>
           <span class="tab-label">我的商户</span>
        </a>
        </nav>
        <!-- 这里是页面内容区 -->
        <div class="content">
          <?php $this->beginBody() ?>
            <?=$content?>
          <?php $this->endBody() ?>
        </div>

    </div>
</div>

  </body>
<!-- 自由输出body bottom -->
<?php if (isset($this->blocks['bottom'])): ?>
   <?= $this->blocks['bottom'] ?>
<?php endif; ?>
<!-- -->
</html>
<?php $this->endPage() ?>

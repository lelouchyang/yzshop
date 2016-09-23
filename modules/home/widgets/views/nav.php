<?php
use app\mysite\helpers\Url;
$isLogin = Yii::$app->auth->isLogin;
$isStaff = Yii::$app->auth->isStaff;
$isSuper = Yii::$app->auth->isSuper;
?>
<nav class="navbar navbar-masthead navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" 
              data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<a class="navbar-brand" href="/">云智动力</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav pull-right">
        <li><a href="/api/doc/shop.html">开发者中心</a></li>
        <?php if($isStaff):?>
        <li><a href="<?=Url::to(['/admin.html'])?>">后台管理</a></li>
        <?php endif;?>
        <?php if($isLogin):?>
           <li><a>当前登陆： <span style="color:green"><?=Yii::$app->auth->user?></span></a></li>
           <!--<li><a href="<?=Url::to(['/profile.html'])?>">个人中心</a></li>-->
           <li><a href="<?=Url::to(['/logout.html'])?>">退出登陆</a></li>
         <?php else:?>
           <li><a href="<?=Url::to(['/admin/login.html'])?>">后台登陆</a></li>
           <!--<li><a href="<?=Url::to(['/register.html'])?>">注册</a></li>-->
         <?php endif;?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

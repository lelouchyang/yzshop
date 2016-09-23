<?php
use yii\helpers\Html;
use \app\mysite\helpers\Url;
use \app\modules\admin\widgets\Menu;
use \app\modules\admin\widgets\Nav;
\app\modules\admin\assets\Admin::register($this);
$menus = Yii::$app->auth->user->adminMenus;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo Html::encode($this->title)?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
      var _pageInfo = '<?=getFlashInfo('pageInfo')?>';
    </script>
    <?php $this->head() ?>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <?php $this->beginBody();?>
    <div class="wrapper">

      <header class="main-header">
        <a href="/admin.html" class="logo">
          <span class="logo-mini"><b>Y</b>Z</span>
          <span class="logo-lg">辽宁口腔医院管理平台</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="">
                <a href="/">
                    网站首页
                </a>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/media/libs/adminlte/img/avatar2.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?=Yii::$app->auth->username;?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="/media/libs/adminlte/img/avatar2.png" class="img-circle" alt="User Image">
                  </li>
                  <li class="text-center">
                     <a href="/admin/logout">退出登陆</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <?=Menu::widget(['menus'=>$menus]) ?>
        </section>
      </aside>

      <div class="content-wrapper">
        <?=$content?>
      </div>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>版本</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://almsaeedstudio.com">YUNZHI DEV</a>.</strong> 
        All rights reserved.
      </footer>
    </div>


    <?php $this->endBody()?>
    
    <?php if (isset($this->blocks['bottom'])): ?>
       <?= $this->blocks['bottom'] ?>
    <?php endif; ?>

  </body>
</html>


<?php $this->endPage() ?>

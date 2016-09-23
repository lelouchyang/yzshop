<?php
use \app\mysite\helpers\Url;
use \app\modules\home\widgets\Nav;
use \app\mysite\helpers\StringHelper;
\app\modules\home\assets\Home::register($this);
?>

<!DOCTYPE html>
<?php $this->beginPage() ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>辽宁口腔医院管理后台</title>

    <?php $this->head();?>
    <!-- Bootstrap -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- TODC Bootstrap theme -->
    <!-- <link href="css/todc-bootstrap.min.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?=Nav::widget() ?>
    <?php if(!StringHelper::startsWith(codename(),'api/doc')):?>
    <div class="container-fulid">
      <div class="bs-docs-header"> 
         <div class="container"> 
            <h1>辽宁口腔医院管理后台</h1> 
         </div> 
      </div>
    </div>
    <?php endif;?>
    <div class="container" style="min-height:400px;">
    <?php $this->beginBody();?>
        <?=$content;?>
    <?php $this->endBody();?>
    </div>
    <div class="container-fulid">
        <div class="row">
            <div class="col-sm-12 footer text-center">
                <p class="text-info">@copyright 2015-2016 云智开发团队</p>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="js/bootstrap.min.js"></script>-->
  </body>
</html>
<?php $this->endPage();?>

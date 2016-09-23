<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
?>
<section class="content-header">
  <h1>
      <i class="fa fa-fw fa-home"></i>
      <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=Url::to(['/admin'])?>"><i class="fa fa-fw fa-home"></i> 首页</a></li>
    <li class="active"><?=$this->title;?></li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
      </div>
    </div>
    <div class="box-body">

      <?=dump($params)?>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

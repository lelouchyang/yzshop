<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
use app\mysite\widgets\editor\Ueditor;
use app\mysite\widgets\upload\Affix;
?>
<section class="content-header">
  <h1>
    <?=$this->title?>
    <small><?=$this->title?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?=$this->title?></h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
<div class="col-sm-6">

<form role="form" method="post" id="carform">
  <div class="box-body">
    <div class="form-group">
      <label for="form-group">文件名</label>
      <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$article->name?>"  name="name">
    </div>
    <div class="form-group">
    

    <div class="checkbox">
      <label>
        <input type="checkbox"> Check me out
      </label>
    </div>
  </div>

  <div class="form-group">
          
            <div class="col-sm-10">
                <?=Affix::widget([
                        'action' => 'admin',
                        'params' => [
                            'res_name'   => 'yz_kouqiangwd',
                            'thumb_conf' => 'yz_kouqiangwd',
                        ]]);?>
            </div>
          </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-primary"> 提交</button>
  </div>
</form>

</div>

    </div><!-- /.box-body -->
    <div class="box-footer">
      
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

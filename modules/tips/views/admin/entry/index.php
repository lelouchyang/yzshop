<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
use app\mysite\widgets\editor\Ueditor;
use app\mysite\widgets\upload\Affix;
?>
<section class="content-header">
  <h1>
      <i class="fa fa-fw fa-home"></i>
      <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
     <li><a href="/"><i class="fa fa-fw fa-home"></i> 首页</a></li>
    
     <li class="active"><a href="#"><?=$this->title;?></a></li>
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
    
    <div class="row">
      <div class="col-sm-10">
    <form class="form form-horizontal" enctype="multipart/form-data" method="post">
   
          
         
          <div class="form-group">
    
            <div class="col-sm-10">
              <?=$datas->text?>
            </div>
          </div>

<a href="<?=Url::to(['/admin/tips/entry/edit','action'=>'update','id'=>"1"])?>" class="btn btn-sm btn-success">
             <i class="fa fa-fw fa-user-plus"></i> 编辑文章</a>
      </div>
     </form>
    </div>

   </div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

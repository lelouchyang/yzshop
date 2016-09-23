




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
     <li><a href="<?=Url::to(['/admin/article/entry/all'])?>"> 表格列表</a></li>
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
    
    	<div class="col-sm-6">
<section class="content">

<form action="/admin/word/entry/upload?id=<?=$article->id?>" method="post" enctype="multipart/form-data" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">文件名</label>
                      <input type="name" class="form-control" name="name" value="<?=$article->name?>">
                    </div>
            
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" id="exampleInputFile" name="pic[]">
                      <p class="help-block">请上传pdf格式.</p>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">保存编辑</button>
                  </div>
                </form>

    </div>

   </section><!-- /.content -->
</div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->


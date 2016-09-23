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
     <li><a href="<?=Url::to(['/admin/article/entry/all'])?>"> 文章列表</a></li>
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
    <input type="hidden" name="id" value="<?=$datas->id?>" />
          
         
          <div class="form-group">
            <label class="control-label col-sm-2">
                文章内容：
            </label>
            <div class="col-sm-10">
            <?=Ueditor::widget([
                        'action' => 'simple',
                        'params' => [
                            'name'    => 'content',
                            'content' => $datas->content,
                        ]
                      ]);?>
            </div>
          </div>


          <div class="form-group">
             <label class="control-label col-sm-2"></label>
             <div class="col-sm-10">
                <button type="submit" class="btn btn-sm btn-primary">保存编辑</button>
                <button type="reset" class="btn btn-sm btn-danger">重置</button>
            </div>
          </div>
     </form>
    </div>

   </div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

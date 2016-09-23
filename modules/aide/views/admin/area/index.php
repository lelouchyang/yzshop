<?php
use app\mysite\helpers\Url;
?>
<section class="content-header">
    <h1 class="span6">
      <i class="fa fa-fw fa-home"></i>
      <?=$this->title?>
    </h1>
  <ol class="breadcrumb">
   <li><a href="/"><i class="fa fa-fw fa-home"></i> 首页</a></li>
   <li><a href="#"><?=$this->title?></a></li>
  </ol>
</section>

<section class="content">



  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?=Url::to(['/admin/aide/area/gen-json'])?>" 
         class="btn btn-success btn-sm pull-right">
         <i class="fa fa-gear"></i> 生成JSON数据</a>
      </div>
    </div>
    <div class="box-body no-padding">

<?php foreach($areas as $area):?>
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"> <strong><?=$area['name'];?></strong></h3>
    </div>
    <div class="box-body">
        <?php if( !empty($area['children']) ):?>
        <ul class="list-inline list-unstyle">
            <?php foreach($area['children'] as $subArea):?>
            <li class=" col-sm-2">
                <a href="<?=Url::to(['/admin/aide/area', 'parent_id'=>$subArea['id']])?>"><?=$subArea['name'];?></a>
            </li>
            <?php endforeach;?>
        </ul>
        <?php else:?>
        暂无数据
        <?php endif;?>
    </div>
  </div>
<?php endforeach;?>


    </div><!-- /.box-body -->
    <div class="box-footer">
      Footer
    </div><!-- /.box-footer-->
  </div><!-- /.box -->



</section><!-- /.content -->

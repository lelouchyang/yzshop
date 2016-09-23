<?php
use app\mysite\helpers\Url;
\app\mysite\assets\TreeTable::register($this);
?>
<section class="content-header">
  <h1>
    <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=Url::home();?>"><i class="fa fa-home"></i> 后台首页</a></li>
    <li class="active"><?=$this->title?></li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
          <button id="btn-expand-all" 
                  class="btn btn-sm btn-default">
             <i class="fa fa-plus-square-o text-gray"></i> 展开所有
          </button>
          <button id="btn-collapse-all" 
                  class="btn btn-sm btn-default">
             <i class="fa fa-minus-square-o text-gray"></i> 折叠所有
          </button>
        <a class="ms-remote-form btn btn-default btn-sm" 
           href="<?=Url::to(['/aide/admin/cate/edit'])?>">
            <i class="fa fa-fw fa-plus text-primary"></i>
            添加顶级分类
        </a>
      </div>
    </div>
    <div class="box-body no-padding">
    <table class="table table-condensed table-bordered" id="category-table">
      <thead>
        <tr>
          <th width="50">ID</th>
          <th width="180">分类名称</th>
          <th width="150">描述</th>
          <th width="50">封面</th>
          <th width="100">操作</th>
        <tr/>
      </thead>
      <tbody>
      <?php foreach($cateList as $cate):?>
      <tr data-tt-id='<?=$cate->id;?>' 
         <?php if($cate->parent_id != 0):?>data-tt-parent-id='<?=$cate->parent_id?>'<?php endif;?> >

          <td><code><?=$cate->id?></code></td>
          <td class="text-primary"><?=$cate->name?></td>
          <td><?=$cate->des?></td>
          <td><?=$cate->cover?></td>
          <td class="text-right">
          <a class="btn btn-xs btn-default ms-remote-form" 
             href="<?=Url::to(['/aide/admin/cate/edit', 'action'=>'add', 'pid'=>$cate->id])?>">
             <i class="fa fa-fw fa-plus text-info"></i>
             添加子分类</a>
          <a class="btn btn-xs btn-default ms-remote-form text-primary" 
             href="<?=Url::to(['/aide/admin/cate/edit', 'action'=>'edit','id'=>$cate->id])?>">
             <i class="fa fa-fw fa-edit text-blue"></i>
             编辑</a>
          <a class="btn btn-xs btn-default ms-confirm" 
             href="<?=Url::to(['/aide/admin/cate/delete', 'id'=>$cate->id])?>">
             <i class="fa fa-fw fa-times text-danger"></i>
             删除</a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
      Footer
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

<script type="text/javascript">
$(function(){
    var treeTable = $('#category-table');
    treeTable.treetable({
        'expandable': true,
        'clickableNodeNames' : true,
        'column' : 1
    });
    $('#btn-expand-all').click(function(e){
        e.preventDefault();
        treeTable.treetable('expandAll');
    });
    $('#btn-collapse-all').click(function(e){
        e.preventDefault();
        treeTable.treetable('collapseAll');
    });
});
</script>

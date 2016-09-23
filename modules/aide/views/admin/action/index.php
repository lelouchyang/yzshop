<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
\app\mysite\assets\TreeTable::register($this);
$this->title = '模块/控制器管理';
?>
<section class="content-header">
  <h1>
    <i class="fa fa-fw fa-th"></i>
    <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-fw fa-dashboard"></i> 首页</a></li>
    <li><a href="<?=Url::to('aide/admin/action')?>">控制器列表</a></li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
          <button id="btn-expand-all" 
                  class="btn btn-primary btn-xs">
             <i class="fa fa-plus-square-o"></i> 展开所有
          </button>
          <button id="btn-collapse-all" 
                  class="btn btn-primary btn-xs">
             <i class="fa fa-minus-square-o"></i> 折叠所有
          </button>
          <a href="<?=url::to(['/aide/admin/action/init'])?>" 
             class="btn btn-xs btn-danger">
             <i class="fa fa-gear"></i> 控制器初始化</a>
      </div>
    </div>
    <div class="box-body no-padding">

  <table id="action-table" class="table table-condensed">
    <tbody>
      <tr>
        <th width="80">ID</th>
        <th width="300">名称</th>
        <th width="100">类别</th>
        <th width="100">子目录</th>
        <th width="300">codename</th>
        <th width="80">菜单</th>
        <th width="100">操作</th>
      </tr>
      <?php foreach($actions as $action):?>
      <tr data-tt-id='<?=$action->id;?>' <?php if($action->parent_id != 0):?>data-tt-parent-id='<?=$action->parent_id?>'<?php endif;?> >

        <td><code style="font-size:80%"><?=$action->id?></code></td>
        <td class="<?=$action->type_color[$action->type]?>">
            <strong><?=$action->getName()?></strong>
        </td>
        <td><?=$action->type_map[$action->type]?></td>
        <td><?=$action->subdir?></td>
        <td><code><?=$action->codename?></code></td>
        <td><?=$action->menu_map[$action->is_menu]?></td>
        <td class="sui-text-right">
            <a href="<?=Url::to(['/aide/admin/action/edit', 'id'=>$action->id])?>" 
               class="btn btn-xs btn-default">
               <i class="fa fa-fw fa-edit"></i>
               编辑
            </a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>


    </div><!-- /.box-body -->
    <div class="box-footer">
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php $this->beginBlock('bottom'); ?>
<script type="text/javascript">
$(function(){
    var actionTable = $('#action-table');
    actionTable.treetable({
        'expandable': true,
        'clickableNodeNames' : true,
        'column' : 1
    });
    $('#btn-expand-all').click(function(e){
        e.preventDefault();
        actionTable.treetable('expandAll');
    });
    $('#btn-collapse-all').click(function(e){
        e.preventDefault();
        actionTable.treetable('collapseAll');
    });
});
</script>
<?php $this->endBlock();?>

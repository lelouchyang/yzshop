<?php
use app\mysite\helpers\Url;
?>
<section class="content-header">
  <h1>
      <i class="fa fa-fw fa-list"></i> 菜单列表
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=Url::home()?>"><i class="fa fa-dashboard"></i> 首页</a></li>
    <li class="action"><a href="<?=Yii::$app->request->url?>">菜单列表</a></li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header">
      <div class="box-tools pull-right">
        <button id="btn-expand-all" 
                class="btn btn-default btn-xs">
           <i class="fa fa-plus-square-o"></i> 展开所有
        </button>
        <button id="btn-collapse-all" 
                class="btn btn-default btn-xs">
           <i class="fa fa-minus-square-o"></i> 折叠所有
        </button>
        <a class="btn btn-default btn-xs" href="<?=Url::to(['/aide/admin/menu/edit', 'action'=>'add']);?>">
          <i class="fa fa-fw fa-plus"></i> 添加菜单
        </a>
        <a class="btn btn-default btn-xs" href="<?=Url::to(['/aide/admin/menu/init']);?>">
          <i class="fa fa-fw fa-plus"></i> 菜单初始化
        </a>
      </div>
    </div>
    <div class="box-body">

    <ul class="nav nav-tabs">
      <?php foreach($sysPanel as $panelId => $panel):?>
      <li class="<?=ifelse($panelId == $currPanelId, 'active')?>">
        <a href="<?=Url::to(['/aide/admin/menu/index', 'p_id'=>$panelId])?>">
           <?=$panel['name']?>
        </a>
      <?php endforeach;?>
    </ul>

  <table id="menu-table" class="table table-bordered table-condensed">
    <tbody>
      <tr>
        <th width="50">ID</th>
        <th width="250">名称</th>
        <th width="250">控制器</th>
        <th width="150">操作</th>
      </tr>
      <?php foreach($menus as $menu):?>
      <tr data-tt-id='<?=$menu->id;?>' <?php if($menu->parent_id != 0):?>data-tt-parent-id='<?=$menu->parent_id?>'<?php endif;?> >

        <td><code><?=$menu->id?></code></td>
        <td>
            <i class="fa fa-fw <?=$menu->icon?>"></i>
            <?=$menu->name?>
        </td>
        <td>
            <?php if($menu->level == 2 && $menu->action):?>
            <code><small><?=$menu->action->codename?></small></code>
            <?php endif;?>
        </td>
        <td class="text-right">
            <?php if($menu->level<3):?>
            <a class="btn btn-default btn-xs" 
               href="<?=Url::to(['/aide/admin/menu/edit', 'parent_id'=>$menu->id])?>">
               <i class="fa fa-fw fa-plus"></i>
               添加子菜单</a>
            <?php endif;?>
            <a class="btn btn-xs btn-default" 
               href="<?=Url::to(['/aide/admin/menu/edit', 'acton'=>'update','id'=>$menu->id])?>">
               <i class="fa fa-fw fa-edit"></i>
               编辑</a>
            <a class="btn btn-xs btn-default ms-confirm" 
               title="删除菜单[<?=$menu->name?>]"
               href="<?=Url::to(['/aide/admin/menu/del', 'id'=>$menu->id])?>">
               <i class="fa fa-fw fa-times"></i>
               删除</a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->
<link href="<?=Url::to('/media/libs/jquery-treetable/css/treetable.css')?>" rel="stylesheet" type="text/css" />
<link href="<?=Url::to('/media/libs/jquery-treetable/css/theme.mysite.css')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=Url::to('/media/libs/jquery-treetable/jquery.treetable.js')?>"></script>
<script type="text/javascript">
$(function(){
    var menuTable = $('#menu-table');
    menuTable.treetable({
        'expandable': true,
        'clickableNodeNames' : true,
        'column' : 1,
        'initialState' : 'expanded'
    });
    $('#btn-expand-all').click(function(e){
        e.preventDefault();
        menuTable.treetable('expandAll');
    });
    $('#btn-collapse-all').click(function(e){
        e.preventDefault();
        menuTable.treetable('collapseAll');
    });
});
</script>

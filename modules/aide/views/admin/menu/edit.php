<?php
use app\mysite\helpers\Url;
use app\mysite\helpers\Html;
?>
<div class="content-header">
  <div class="sui-row-fluid">
    <h2 class="span6"><?=$this->title?></h2>
    <ul class="span6 sui-breadcrumb sui-text-right">
      <li><a href="<?=Url::home();?>"><i class="fa fa-fw fa-home"></i> 首页</a></li>
      <li><a href="<?=Url::to(['/aide/admin/menu'])?>">菜单列表</a></li>
      <li class="action"><?=$this->title?></a>
    </ul>
  </div>
</div>

<div class="content-inner">
<form class="sui-form form-horizontal" method="post">
  <input type="hidden" name="id" value="<?=$menu->id?>" />
  <div class="control-group">
    <label class="control-label">父菜单：</label>
    <div class="controls">
      <select name="parent_id" class="input-fat input-large">
        <option>顶级菜单</option>
        <?=Html::renderSelectOptions($menu->parent_id, $menus)?>
      </select>
    </div>
  </div>

  <div class="control-group">
      <label class="control-label">关联控制器：</label>
      <div class="controls">
        <select name="action_id" class="input-fat input-large">
          <option value="0">选择控制器</option>
          <?=Html::renderSelectOptions($menu->action_id, $action_menus)?>
        </select>
      </div>
  </div>

  <div class="control-group">
      <label class="control-label">菜单名称：</label>
      <div class="controls">
        <input name="name" value="<?=$menu->name?>" 
                 type="text" class="input-fat input-large" placeholder="菜单名称">
      </div>
  </div>

  <div class="control-group">
     <label class="control-label">图标：</label>
     <div class="controls">
     <input name="icon" value="<?=$menu->icon?>" 
            type="text" class="input-fat input-large" placeholder="菜单名称">
     </div>
  </div>

  <div class="control-group">
     <label class="control-label"></label>
     <div class="controls">
        <button type="submit" class="sui-btn btn-primary">保存编辑</button>
     </div>
  </div>

</form>
</div>

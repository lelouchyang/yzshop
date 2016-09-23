<?php
/* @var $this yii\web\View */

use app\mysite\helpers\Url;

$this->title = '控制器编辑';
?>

<div class="content-header">
  <div class="sui-row-fluid">
      <h2 class="span6">
        控制器/方法编辑
        <small><?=$record->codename?></small>
      </h2>
      <ul class="span6 sui-breadcrumb sui-text-right">
        <li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="<?=Url::to('/aide/admin/action.html')?>">控制器列表</a></li>
        <li class="active">编辑</li>
      </ul>
  </div>
</div>

  <div class="content-inner">
    <hr class="blank-line" />
    <form class="sui-form form-horizontal" method="post">
      <input type="hidden" name="id" value="<?=$record->id?>" />
      <div class="control-group">
        <label class="control-label">代码标识：</label>
        <div class="controls">
          <input type="text" class="input-fat input-xxlarge" disabled
                 value="<?=$record->codename;?>"
                 id="codename-input-id" />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">类 别：</label>
        <div class="controls">
          <input type="text" class="input-fat input-large" disabled
                 value="<?=$record->type_map[$record->type]?>" />
        </div>
        <label class="control-label">子目录：</label>
        <div class="controls">
          <input type="text" class="input-fat input-large" disabled
                 value="<?=$record->subdir?>" />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">控制器：</label>
        <div class="controls">
          <input type="text" class="input-fat input-large" disabled
                 value="<?=$record->controller?>" />
        </div>
        <label class="control-label">方 法：</label>
        <div class="controls">
          <input type="text" class="input-fat input-large" disabled
                 value="<?=$record->action?>" />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">名 称：</label>
        <div class="controls">
          <input type="text" class="input-fat input-large" 
                 name="custom_name"
                 value="<?=$record->getName();?>"
                 id="name-input" placeholder="控制器名称" />
        </div>
        <label class="control-label">菜 单：</label>
        <div class="controls">
          <label data-toggle="checkbox" class="input-fat checkbox-pretty inline">
             <input disabled type="checkbox" value="1" <?php if($record->is_menu == 1):?>checked<?php endif;?> />
             <span>是</span>
          </label>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">描 述：</label>
        <div class="controls">
          <textarea class="input-fat input-xxlarge" 
                    name="custom_des"
                    id="desc-input" placeholder="控制器描述"><?=$record->getDes();?></textarea>
        </div>
      </div>

      <div class="control-group">
         <label class="control-label"></label>
         <div class="controls">
           <button type="submit" class="sui-btn btn-primary">保 存 修 改</button>
           <button type="reset" class="sui-btn">重置</button>
         </div>
      </div>

    </form>

</div>


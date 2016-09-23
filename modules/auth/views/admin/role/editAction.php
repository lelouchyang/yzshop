<?php
use app\mysite\helpers\Url;
?>

<section class="content-header">
  <h1>
     <?=$this->title?> <span class="text-primary">[<?=$role->name?>]</span>
     <small><?=$role->des?></small>
  </h1>
  <ol class="breadcrumb">
       <li><a href="<?=Url::home()?>"><i class="fa fa-dashboard"></i> 后台首页</a></li>
       <li><a href="<?=Url::to(['/admin/auth/role'])?>">角色组列表</a></li>
       <li class="active"><?=$this->title?></li>
  </ol>
</section>

<section class="content">
  <div class="box box-solid">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
      </div>
    </div>
    <div class="box-body">

        <div class="row">
          <div class="col-sm-10">
        <form action="<?=Yii::$app->request->url?>">
        <input type="hidden" name="role_id" value="<?=$role->id?>"/>
          <?php foreach($actions as $actionGroup):?>
          <div class="box box-solid box-action">
            <div class="box-header with-border ">
              <h1 class="box-title text-primary">
                <?=$actionGroup['name']?>
              </h1>
              <div class="box-tools">
                 <div class="form-group">
                  <label class="checkbox-inline">
                      <input class="group-action icheck-checkbox" 
                             value="<?=$actionGroup['id']?>" name="group_id" type="checkbox" /> 全 选
                  </label>
                 </div>
              </div>
            </div>
            <div class="panle-body box-body" id="group-<?=$actionGroup['id']?>">
                <?php foreach($actionGroup['children'] as $action):?>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>
                    <input data-role-id="<?=$role->id?>" 
                           class="action icheck-checkbox" 
                           type="checkbox" name="action_id" 
                           <?php if(in_array($action['id'], $jumpAuthCheck)):?>
                           checked disabled
                           <?php elseif(in_array($action['id'], $hasActions)):?>
                           checked
                           <?php endif;?>
                           value="<?=$action['id']?>" />
                    <?=$action['name']?>
                    </label>
                  </div>
                </div>
                <?php endforeach;?>
             </div>
          </div>
          <?php endforeach;?>
        </form>
          </div>
          <div class="col-sm-2">


            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">角色分组</h3>
                  <div class="box-tools">
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                   <?php foreach($roles as $role):?>
                   <li><a href="<?=Url::to(['/admin/auth/role/edit-action', 'id'=>$role->id])?>">
                        <i class="fa fa-circle-o text-red"></i> <?=$role->name?></a>
                   </li>
                   <?php endforeach;?>
                  </ul>
                </div><!-- /.box-body -->
              </div>

          </div>
        </div>

    </div>
  </div>

</section><!-- /.content -->


<script type="text/javascript">
$(function(){
  $('div.box-action input[type="checkbox"].icheck-checkbox').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
  });
  $('input.group-action').on('ifChecked', function(){
      $('#group-'+$(this).val()).find('input').iCheck('check');
  });
  $('input.group-action').on('ifUnchecked', function(){
      $('#group-'+$(this).val()).find('input').iCheck('uncheck');
  });
  // add
  $('input.action').on('ifChecked', function(){
      var $this = $(this);
      var url = $this.parents('form:first').attr('action');
      var datas = {
        'role_id'   : $this.data('roleId'),
        'action_id' : $this.val(),
        'option'    : 'add'
      };
      $.post(url, datas, function(xhr) {}, 'json');
  });
  // del
  $('input.action').on('ifUnchecked', function(){
      var $this = $(this);
      var url = $this.parents('form:first').attr('action');
      var datas = {
        'role_id'   : $this.data('roleId'),
        'action_id' : $this.val(),
        'option'    : 'del'
      };
      $.post(url, datas, function(xhr) {}, 'json');
  });
});
</script>


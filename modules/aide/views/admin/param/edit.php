<?php
use app\mysite\helpers\Url;
?>
<form id="key-value-form" class="form form-horizontal" method="post">
<input type="hidden" name="id" value="<?=$param->id?>" />
  <div class="form-group">
    <label class="col-sm-2 control-label">键：</label>
    <div class="col-sm-9">
     <input name="name" type="text" placeholder="键" 
            class="form-control input-sm" value="<?=$param->name?>" />
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">类 型：</label>
    <div class="col-sm-8">
        <label class="radio-inline">
        <input type="radio" <?=ifelse($param->type == 'string', 'checked')?> name="type" value="string"> 字符串
        </label> 
        <label class="radio-inline">
          <input type="radio" <?=ifelse($param->type == 'array', 'checked')?>  name="type" value="array"> 数 组
        </label> 
        <label class="radio-inline">
          <input type="radio" <?=ifelse($param->type == 'dictory', 'checked')?>  name="type" value="dictory"> 键值对
        </label>
    </div>
    <label class="col-sm-1 control-label">
       <a id="add-item-btn" style="<?=ifelse($param->type == 'string', 'display:none')?>"
          class="pull-right" href="#">
          <i class="text-gray fa fa-fw fa-plus-circle"></i>
       </a> 
    </label>
   </div>

   <div id="key-value-string" class="value-box" 
        style="<?=ifelse($param->type != 'string', 'display:none')?>">

       <div class="form-group">
        <label class="col-sm-2 control-label">值：</label>
            <div class="col-sm-9">
            <input type="text" name="value" value="<?=$param->value?>" placeholder="值"
                       class="form-control input-sm" />
            </div>
       </div>
   </div>

   <div id="key-value-array" class="value-box"
        style="<?=ifelse($param->type != 'array', 'display:none')?>">
        <?php if($param->id && $param->type != 'string'):?>
       <?php foreach($param->realValue as $value):?>
       <div class="form-group">
            <label class="col-sm-2 control-label">项：</label>
            <div class="col-sm-8">
            <input type="text" name="array_value[]" value="<?=$value?>" placeholder="值"
                       class="form-control input-sm" />
            </div>
            <div class="col-sm-1">
                <a class="btn-del" href="#"><i class="text-gray fa fa-fw fa-times-circle"></i></a>
            </div>
       </div>
       <?php endforeach;?>
        <?php else:?>
       <div class="form-group">
            <label class="col-sm-2 control-label">项：</label>
            <div class="col-sm-8">
            <input type="text" name="array_value[]" value="" placeholder="值"
                       class="form-control input-sm" />
            </div>
            <div class="col-sm-1">
                <a class="btn-del" href="#"><i class="text-gray fa fa-fw fa-times-circle"></i></a>
            </div>
       </div>
        <?php endif;?>
   </div>

   <div id="key-value-dictory" class="value-box"
        style="<?=ifelse($param->type != 'dictory', 'display:none')?>">

       <?php if($param->id && $param->type!='string'):?>
       <?php foreach($param->realValue as $key=>$value):?>
       <div class="form-group">
            <label class="col-sm-2 control-label">项：</label>
            <div class="col-sm-4">
            <input type="text" name="dict_key[]" value="<?=$key?>" placeholder="键"
                   class="form-control input-sm" /> 
            </div>
            <div class="col-sm-4">
            <input type="text" name="dict_value[]" value="<?=$value?>" placeholder="值"
                   class="form-control input-sm" />
            </div>
            <div class="col-sm-1">
                <a class="btn-del" href="#"><i class="fa fa-fw fa-times"></i></a>
            </div>
       </div>
       <?php endforeach;?>
       <?php else:?>
       <div class="form-group">
            <label class="col-sm-2 control-label">项：</label>
            <div class="col-sm-4">
                <input type="text" name="dict_key[]" value="" placeholder="键"
                       class="form-control input-sm" /> 
            </div>
            <div class="col-sm-4">
                <input type="text" name="dict_value[]" value="" placeholder="值"
                       class="form-control input-sm" />
            </div>
            <div class="col-sm-1">
                <a class="btn-del" href="#"><i class="fa fa-fw fa-times"></i></a>
            </div>
       </div>

       <?php endif;?>

   </div>

   <div class="form-group">
    <label class="col-sm-2 control-label">描 述：</label>
    <div class="col-sm-9">
        <textarea name="des" class="form-control input-sm" placeholder="描述" rows=3></textarea>
    </div>
   </div>
</form>
<script type="text/javascript">
$(function(){

    var typeRadio = $('#key-value-form input[type="radio"]');
    typeRadio.iCheck({
      radioClass: 'iradio_minimal-green',
    });

    typeRadio.on('ifChanged', function(){
        var $this = $(this);
        var type = $this.val();
        if ( type != 'string') {
            $('#add-item-btn').show();    
        } else {
            $('#add-item-btn').hide();    
        }
        $('div.value-box').hide();
        $('#key-value-'+type).show();
    });

    $('#add-item-btn').click(function(e){
        e.preventDefault();
        var target = $('div.value-box:visible');
        var newInput = target.find('div.form-group:first').clone();
        console.dir(newInput);
        newInput.find('input').val('');
        newInput.hide();
        target.append(newInput);
        newInput.fadeIn();
    });

    $('a.btn-del').css({'cursor':'pointer'});
    $('#key-value-form').on('click', 'a.btn-del', function(e){
        e.preventDefault();
        var $this = $(this);
        var formGroup = $this.parents('div.form-group:first');
        if ( formGroup.siblings().length > 0 ) {
            formGroup.fadeOut(function(){
                $(this).remove();
            });
        } else {
            formGroup.find('input').val('');
        }
    });
});
</script>

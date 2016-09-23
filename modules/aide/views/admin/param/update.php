<?php
use app\mysite\helpers\Url;
?>
<form id="key-value-form" class="sui-form form-horizontal" method="post">

  <div class="control-group">
    <label class="control-label">键：</label>
    <div class="controls">
      <input name="name" type="text" placeholder="键" 
             class="input-xlarge" value="<?=$param->name?>" />
    </div>
  </div>

  <div class="control-group">
    <label class="control-label">类 型：</label>
    <div class="controls">
        <label class="radio-inline">
         <input type="radio" <?php if($param->type=="string"):?>checked<?php endif;?> 
                name="type" value="string"> 字符串
        </label> 
        <label class="radio-inline">
          <input type="radio" <?php if($param->type=="array"):?>checked<?php endif;?>
                 name="type" value="array"> 数 组
        </label> 
        <label class="radio-inline">
          <input type="radio" <?php if($param->type=="dictory"):?>checked<?php endif;?>
                 name="type" value="dictory"> 键值对
        </label>
    </div>
    <label class="control-label">
       <a id="add-item-btn" style="<?php if($param->type == 'string'):?>display:none"<?php endif;?>
          class="pull-right" href="#">
          <i class="fa fa-fw fa-plus"></i>
       </a> 
    </label>
   </div>

   <div id="key-value-string" 
        <?php if($param->type !="string"):?>
        style="display:none;"
        <?php endif;?>
        class="value-box">
       <div class="control-group">
        <label class="control-label">值：</label>
        <div class="controls">
          <div class="input-group">
            <input type="text" name="value" 
                   value="<?php if($param->type == 'string'):?><?=$param->value?><?php endif;?>" 
                   placeholder="值"
                   class="input-xlarge" />
            <span class="sui-pull-right"><i class="fa fa-fw fa-times"></i></span>
          </div>
        </div>
       </div>
   </div>

   <div id="key-value-array" 
        <?php if($param->type !="array"):?>
        style="display:none;"
        <?php endif;?>
        class="value-box">
       <?php if($param->type == "array"):?>
       <?php foreach($param->realValue as $value):?>
       <div class="control-group">
        <label class="control-label">项：</label>
        <div class="controls">
          <div class="input-group">
            <input type="text" name="array_value[]" value="<?=$value?>" placeholder="值"
                   class="input-xlarge" />
            <span class="btn-del input-group-addon"><i class="fa fa-fw fa-times"></i></span>
          </div>
        </div>
       </div>
       <?php endforeach;?>
       <?php else:?>
       <div class="control-group">
        <label class="control-label">项：</label>
        <div class="controls">
          <div class="input-group">
            <input type="text" name="array_value[]" value="" placeholder="值"
                   class="input-xlarge" />
            <span class="btn-del input-group-addon"><i class="fa fa-fw fa-times"></i></span>
          </div>
        </div>
       </div>
       <?php endif;?>
   </div>

   <div id="key-value-dictory" 
        <?php if($param->type !="dictory"):?>
        style="display:none;"
        <?php endif;?>
        class="value-box">
       <?php if($param->type == 'dictory'):?>
       <?php foreach($param->realValue as $key=>$value):?>
       <div class="control-group">
        <label class="control-label">项：</label>
        <div class="controls">
          <input type="text" class="" name="dict_key[]" value="<?=$key;?>" placeholder="键" /> 
        </div>
        <div class="controls">
          <div class="input-group">
            <input style="width:182px;"type="text" name="dict_value[]" value="<?=$value?>" placeholder="值"
                   class="input-large" />
            <span class="btn-del input-group-addon"><i class="fa fa-fw fa-times"></i></span>
          </div>
        </div>
       </div>
       <?php endforeach;?>
       <?php else:?>
       <div class="control-group">
        <label class="control-label">项：</label>
        <div class="controls">
            <input type="text" class="" name="dict_key[]" value="" placeholder="键" /> 
        </div>
        <div class="controls">
          <div class="input-group">
            <input style="width:182px;"type="text" name="dict_value[]" value="" placeholder="值"
                   class="input-large" />
            <span class="btn-del input-group-addon"><i class="fa fa-fw fa-times"></i></span>
          </div>
        </div>
       </div>
        <?php endif;?>
   </div>

   <div class="control-group">
    <label class="control-label">描 述：</label>
    <div class="controls">
      <textarea name="des" class="input-xlarge" placeholder="描 述" rows=3><?=$param->des?></textarea>
    </div>
   </div>
</form>
<link href="<?=Url::to('/media/libs/iCheck/minimal/_all.css')?>" rel="stylesheet" type="text/css" />-
<script src="<?=Url::to('/media/libs/iCheck/icheck.min.js')?>" type="text/javascript"></script>
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
        var newInput = target.find('div.control-group:first').clone();
        newInput.find('input').val('');
        newInput.hide();
        target.append(newInput);
        newInput.fadeIn();
    });

    $('span.btn-del').css({'cursor':'pointer'});
    $('#key-value-form').on('click', 'span.btn-del', function(e){
        e.preventDefault();
        var $this = $(this);
        var formGroup = $this.parents('div.control-group:first');
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

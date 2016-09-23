<form class="form-horizontal" role="form" method="post">
  <input type="hidden" name="user_id" value="<?=$user->id?>" />
  <div class="form-group role-box">
    <?php foreach($roles as $role):?>
    <div class="col-xs-3">
    <label>
    <input data-role-id="<?=$role->id?>" class="action icheck-checkbox" 
           <?php if(in_array($role->id, $has_roles)):?>checked<?php endif;?>
           type="checkbox" name="role_id[]" value="<?=$role->id?>" />
        <?=$role->name?>
    </label>
    </div>
    <?php endforeach;?>
  </div>
</form>
<script type="text/javascript">
$(function(){
  $('div.role-box input[type="checkbox"].icheck-checkbox').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
  });
});
</script>


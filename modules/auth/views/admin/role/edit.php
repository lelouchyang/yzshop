<form class="form-horizontal" method="post">
    <input type="hidden" name="id" value="<?=$role->id?>" />
    <div class="form-group">
        <label class="col-sm-2 control-label">角 色：</label>
        <div class="col-sm-9">
          <input name="name" type="text" class="form-control input-sm" 
                 value="<?=$role->name?>" id="name-id" />
        </div>
     </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">描 述：</label>
        <div class="col-sm-9">
            <textarea name="des" class="form-control input-sm" rows=3><?=$role->des?></textarea>
        </div>
     </div>
</form>

<form class="form-horizontal" method="post" id="carform">
    <input type="hidden" name="id" value="<?=$data->id?>" />
    <div class="form-group">
        <label class="col-sm-2 control-label">编号：</label> 
        <div class="col-sm-2">
          <input name="number" type="text" class="form-control input-sm" 
                 value="<?=$data->number?>" id="name-id" />
        </div>
     </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">姓名：</label> 
        <div class="col-sm-2">
          <input name="name" type="text" class="form-control input-sm" 
                 value="<?=$data->name?>" id="name-id" />
        </div>
     </div>
     <div class="form-group">
     <label class="col-sm-2 ">性别：</label> 
  <select name="sex" form="carform">
  <option value ="1" >男</option>
  <option value ="2" >女</option>
  </select>
  </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">进修科室：</label> 
        <div class="col-sm-2">
          <input name="department" type="text" class="form-control input-sm" 
                 value="<?=$data->department?>" id="name-id" />
        </div>
     </div>
</form>

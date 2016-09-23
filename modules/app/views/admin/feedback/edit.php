<form class="form-horizontal" method="post">
    <input type="hidden" name="id" value="<?=$appFeedback->id?>" />
    <div class="form-group">
        <label class="col-sm-2 control-label">反馈内容：</label>
        <div class="col-sm-9">
          <input name="content" type="text" class="form-control input-sm" 
                 value="<?=$appFeedback->content?>" id="name-id" />
        </div>
     </div>
</form>

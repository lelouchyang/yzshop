<section class="content-header">
  <h1>
    Blank page
    <small>it all starts here</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?=$this->title?></h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">

<div class="col-sm-6">

<form role="form" method="post">
  <div class="box-body">
    <div class="form-group">
      <label for="form-group">版本信息号</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="版本信息号" name="version_code">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">发布时间</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="发布时间" name="published_time">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">安卓下载地址</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="安卓下载地址" name="android_url">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">ios appstore地址</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="ios appstore地址" name="ios_url">
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">产品信息描述：</label>
        <div class="col-sm-9">
            <textarea name="des" class="form-control input-sm" rows=3></textarea>
        </div>
     </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">关于：</label>
        <div class="col-sm-9">
            <textarea name="about_page" class="form-control input-sm" rows=3></textarea>
        </div>
     </div>
    <div class="checkbox">
      <label>
        <input type="checkbox"> Check me out
      </label>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>

</div>

    </div><!-- /.box-body -->
    <div class="box-footer">
      
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

<section class="content-header">
  <h1>
      <i class="fa fa-fw fa-user"></i> <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin/site.html"><i class="fa fa-home"></i> 首页</a></li>
    <li class="action"><a href="/admin/app/version.html">APP版本列表</a></li>
  </ol>
</section>

<section class="content">
  <div class="box box-default">
     <div class="box-header">
        <h3 class="box-title"></h3>
      </div>
      <div class="box-body">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?=$version->id?>" />
      <div class="row">
        <div class="col-sm-8">
           
           <div class="form-group text-warning">
           <label class="col-sm-3 control-label">版本序号：</label>
             <div class="col-sm-9">
               <input name="version_code" placeholder="版本序号" type="text" 
                      class="form-control input-sm" value="<?=$version->version_code;?>" />
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="control-label col-sm-3">版本号(用户)：</label>
             <div class="col-sm-9">
               <input name="version_name" placeholder="版本号(用户)" type="text" 
               class="form-control input-sm" value="<?=$version->version_name;?>" />
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="control-label col-sm-3">版本说明：</label>
             <div class="col-sm-9">
                <textarea placeholder="版本说明" name="content" class="form-control" rows="7"><?=$version->content;?></textarea>
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="control-label col-sm-3">安卓下载地址：</label>
             <div class="col-sm-9">
               <input name="android_url" placeholder="安卓下载地址" type="text" 
                      class="form-control input-sm" value="<?=$version->android_url;?>" />
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="control-label col-sm-3">ios下载地址：</label>
             <div class="col-sm-9">
               <input name="ios_url" placeholder="安卓下载地址" type="text" 
                      class="form-control input-sm" value="<?=$version->ios_url;?>" />
                      <span class="help-block">可根据上传自动生成</span>
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="control-label col-sm-3">是否发布：</label>
             <div class="col-sm-9">
                <label class="radio-inline">
                <input <?=ifelse($version->is_published, 'checked')?> 
                       type="radio" name="is_published" value="1"> 发布
                </label>
                <label class="radio-inline">
                    <input <?=ifelse($version->is_published==0, 'checked')?> 
                           type="radio" name="is_published" value="0"> 暂不发布
                </label>
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="control-label col-sm-3">上传app：</label>
             <div class="col-sm-9">
                <input type="file" name="apk" class="form-control" />
             </div>
           </div>

        </div>
        <div class="col-sm-6">
            <!-- 权限设置 -->
        </div>
        <div class="col-sm-12">
           <div class="form-group">
               <div class="col-sm-6 text-center">
                  <button type="submit" class="btn btn-primary">保 存</button>
                  <button type="reset" class="btn btn-warning">重 置</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
</section>

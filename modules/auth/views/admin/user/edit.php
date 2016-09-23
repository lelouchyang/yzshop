<section class="content-header">
  <h1>
      <i class="fa fa-fw fa-user"></i> <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin/site.html"><i class="fa fa-home"></i> 首页</a></li>
    <li class="action"><a href="<?=Yii::$app->request->url?>">用户列表</a></li>
  </ol>
</section>

<section class="content">
  <div class="box box-default">
     <div class="box-header">
        <h3 class="box-title"></h3>
      </div>
      <div class="box-body">
      <form class="form-horizontal" method="post">
      <input type="hidden" name="id" value="<?=$user->id?>" />
      <div class="row">
        <div class="col-sm-6">
           
           <div class="form-group text-warning">
           <label class="col-sm-3 control-label">用户名：</label>
             <div class="col-sm-9">
               <input name="username" placeholder="用户名" type="text" 
                      class="form-control input-sm" value="<?=$user->username;?>" />
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="control-label col-sm-3">密 码：</label>
             <div class="col-sm-9">
               <input name="password" placeholder="密码" type="password" 
               class="form-control input-sm" value="" />
             </div>
           </div>

           <div class="form-group text-warning">
             <label class="col-sm-3 control-label">重复密码：</label>
             <div class="col-sm-9">
               <input name="repassword" placeholder="重复密码" type="password" class="form-control input-sm" value="" />
             </div>
           </div>

            <div class="form-group text-warning">
              <label class="col-sm-3 control-label">账户类型：</label>
              <div class="col-sm-9">
                <label class="checkbox-inline">
                <input <?=ifelse($user->is_staff==1,'checked')?>
                       class="minimal" name="is_staff" type="checkbox" value="1"> 员工
                </label>
                <label class="checkbox-inline">
                <input <?=ifelse($user->is_staff==2, 'checked')?>
                       class="minimal" name="is_staff" type="checkbox" value="2"> 离职员工
                </label>
                <label class="checkbox-inline">
                <input <?=ifelse($user->is_super==1, 'checked')?>
                       class="minimal" name="is_super" type="checkbox" value="1"> 超级用户
                </label>
              </div>
           </div>
           <div class="form-group">
             <div class="col-sm-12">
                <hr style="margin:10px 0px 0px 0px;"/>
             </div>
           </div>


           <div class="form-group">
             <label class="col-sm-3 control-label">性 别：</label>
             <div class="col-sm-9">
               <label class="radio-inline">
               <input <?=ifelse($user->gender==1, 'checked')?>
                      class="minimal" type="radio" name="gender" id="gender-id" value="1" checked> 男
               </label>
               <label class="radio-inline">
                   <input <?=ifelse($user->gender==2, 'checked')?>
                          class="minimal" type="radio" name="gender" id="gender-id" value="2"> 女
               </label>
             </div>
           </div>

           <div class="form-group">
             <label class="col-sm-3 control-label">昵称：</label>
             <div class="col-sm-9">
               <input name="nickname" placeholder="昵称" type="text" 
                      class="form-control input-sm" value="<?=$user->nickname;?>" />
             </div>
           </div>
           <div class="form-group">
             <label class="col-sm-3 control-label">真实姓名：</label>
             <div class="col-sm-9">
               <input name="realname" placeholder="真实姓名" type="text" 
                      class="form-control input-sm" value="<?=$user->realname?>" />
             </div>
           </div>

           <div class="form-group">
             <label class="col-sm-3 control-label">电子邮件：</label>
             <div class="col-sm-9">
               <input name="email" placeholder="电子邮件" type="email" 
                      class="form-control input-sm" value="<?=$user->email?>" />
             </div>
            </div>

           <div class="form-group">
             <label class="col-sm-3 control-label">手机号码：</label>
             <div class="col-sm-9">
               <input name="mobile" placeholder="手机号码" type="text" 
                      class="form-control input-sm" value="<?=$user->mobile;?>" />
             </div>
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

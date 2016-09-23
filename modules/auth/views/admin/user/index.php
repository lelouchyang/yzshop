<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
$this->title = '用户列表';
// 共享给上一层
$this->params['pagination'] = $pagination;
?>

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

  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
          <a href="<?=url::toRoute(['/auth/admin/user/edit', 'action'=>'add'])?>" 
             class="btn btn-sm btn-success">
             <i class="fa fa-fw fa-user-plus"></i>  添加用户</a>
      </div>
    </div>
    <div class="box-body no-padding">
      <div class="well well-sm well-search-form" style="margin:10px;">
        <form class="form-inline">
          <div class="form-group">
            <label for="">账号 </label>
            <input type="text" placeholder="帐号">
          </div>
          <div class="form-group">
            <label for="">手机号 </label>
            <input type="text" placeholder="手机号">
          </div>
          <button type="submit" class="btn btn-default btn-xs">
              <i class="fa fa-fw fa-search"></i>搜索</button>
        </form>
      </div>

      <table id="action-table" class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th width="50">ID</th>
            <th width="100">账号</th>
            <th width="100">用户名</th>
            <th width="100">角色</th>
            <th width="120">邮箱</th>
            <th width="120">手机</th>
            <th width="80">员工</th>
            <th width="80">管理员</th>
            <th width="80">状态</th>
            <th width="150">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($records as $user):?>
          <tr>
            <td><span class="text-primary small">[<?=sprintf('%05d',$user->id)?>]</span></td>
            <td class="text-info"><?=$user->username;?></td>
            <td>[<?=$user->gender_map[$user->gender]?>]<strong><?=$user?></strong></td>
            <td>
                <?php foreach($user->getRoles(true) as $role):?>
                <?=$role['name'];?>
                <?php endforeach;?>
            </td>
            <td class="text-info"><small><?=$user->email?></small></td>
            <td class="text-danger"><small><?=$user->mobile?></small></td>
            <td><?=$user->is_staff_map[$user->is_staff]?></td>
            <td><?=$user->is_super_map[$user->is_super]?></td>
            <td><?=$user->status_map[$user->status]?></td>
            <td class="sui-text-right">
              <?php if($user->is_staff):?>
              <a class="btn btn-xs btn-default ms-remote-form" 
                 title="编辑角色[<?=$user->username?>]"
                 href="<?=Url::to(['/auth/admin/user/edit-role', 'id'=>$user->id])?>">
                <i class="fa fa-fw fa-edit text-danger"></i>
              角色组 </a>
              <?php endif;?>
              <a class="btn btn-xs btn-default text-primary"
                 href="<?=Url::to(['/auth/admin/user/edit', 'action'=>'update', 'id'=>$user->id])?>">
                <i class="fa fa-fw fa-edit text-info"></i>
              编辑</a>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>

    </div><!-- /.box-body -->
    <div class="box-footer">
<?=$pagination?> 
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

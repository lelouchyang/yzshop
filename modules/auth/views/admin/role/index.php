<?php
use app\mysite\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;

$provider = new ActiveDataProvider([
    'query' => \app\mysite\models\AuthRole::find()->where(['status'=>1]),
    'sort' => [
        'defaultOrder' => [
            'id' => SORT_DESC, 
        ]
    ],
    'pagination' => [
        'pageSize' => 30,
    ],
]);

$roles = $provider->getModels();
$page = $provider->getPagination();

?>
<section class="content-header">
  <h1>
    <?=$this->title?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=Url::home()?>"><i class="fa fa-home"></i> 后台首页</a></li>
    <li class="active"><?=$this->title?></li>
  </ol>
</section>

<section class="content">

  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
       <a title="添加角色组" 
          href="<?=Url::to(['/auth/admin/role/edit', 'action'=>'add'])?>"
          class="ms-remote-form btn btn-sm btn-success"><i class="fa fa-plus"></i> 添加权限组</a>
      </div>
    </div>
    <div class="box-body no-padding">

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
          <th width="50">ID</th>
          <th width="150">名称</th>
          <th width="300">描述</th>
          <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($roles as $role):?>
      <tr>
        <td><?=$role->id?></td>
        <td><?=$role->name?></td>
        <td><?=$role->des?></td>
        <td>
            <a class="text-primary btn btn-xs btn-default" title="编辑角色"
               href="<?=Url::to(['/auth/admin/role/edit-action', 'id'=>$role->id])?>">
               <i class="fa fw fa-users"></i> 权限设置</a>
            <a class="text-info ms-remote-form btn btn-xs btn-default" title="编辑角色"
               href="<?=Url::to(['/auth/admin/role/edit', 'action'=>'update','id'=>$role->id])?>">
               <i class="fa fw fa-edit"></i> 编辑</a>
             <?php $msg = '您确认要删除角色［'.$role->name.'］吗?';?>    
             <a class="ms-confirm btn btn-xs btn-default text-danger " data-message="<?=$msg?>"
               href="<?=Url::to(['/auth/admin/role/del', 'id'=>$role->id])?>">
               <i class="fa fw fa-times"></i> 删除</a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>



    </div><!-- /.box-body -->
    <div class="box-footer">
        记录总数:共<code><?=$page->totalCount;?></code>条
        <?=LinkPager::widget([ 'pagination' => $page, ])?>
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

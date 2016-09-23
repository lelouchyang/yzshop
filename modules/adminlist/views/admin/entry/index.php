<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
// 共享给上一层
$this->params['pagination'] = $pagination;
?>

<section class="content-header">
  <h1>
    <?=$this->title?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=Url::home()?>"><i class="fa fa-home"></i> 录取名单管理</a></li>
    <li class="active"><?=$this->title?></li>
  </ol>
</section>

<section class="content">

  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
      <a href="<?=Url::to(['/admin/adminlist/entry/edit','action'=>'add'])?>" class="btn btn-sm btn-success">
             <i class="fa fa-fw fa-user-plus"></i>  添加录取人员</a>
      </div>
    </div>
    <div class="box-body no-padding">

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
          
          <th width="300">编号</th>
          <th width="100">姓名</th>
          <th width="300">性别</th>
          <th width="100">进修科室</th>
          <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($records as $info):?>
      <tr>
        <td><?=$info->number?></td>
        <td><?=$info->name?></td>
        <td>
        <?php if($info->sex == 1):?>
        男
        <?php else:?>
        女
        <?php endif;?>
        </td>
        <td><?=$info->department?></td>
        <td>
        <?php $id = $info->id;?>
            
            <a class="text-info ms-remote-form btn btn-xs btn-default" title="编辑学生"
               href="<?=Url::to(['/admin/adminlist/entry/edit','action'=>'update','id'=>$id])?>">
               <i class="fa fw fa-edit"></i> 编辑</a>
             <?php $msg = '您确认要删除［'.$info->name.'］吗?';?>    
             <a class="ms-confirm btn btn-xs btn-default text-danger " data-message="<?=$msg?>"
               href="<?=Url::to(['/admin/adminlist/entry/del', 'id'=>$id])?>">
               <i class="fa fw fa-times"></i> 删除</a>
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

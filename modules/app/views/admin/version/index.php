<?php
use app\mysite\helpers\Url;
?>
<section class="content-header">
  <h1>
    <?=$this->title?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=Url::home()?>"><i class="fa fa-home"></i> 首页</a></li>
    <li class="active"><?=$this->title?></li>
  </ol>
</section>

<section class="content">

  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
      <a href="<?=Url::to(['/app/admin/version/edit','action'=>'add'])?>" class="btn btn-sm btn-success">
             <i class="fa fa-fw fa-user-plus"></i>  添加版本信息</a>
      </div>
    </div>
    <div class="box-body no-padding">

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
          <th width="150">版本号</th>
          <th width="150">版本名称</th>
          <th width="150">上传文件</th>
          <th width="300">描述</th>
          <th width="80">下载次数</th>
          <th width="300">下载</th>
          <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($records as $version):?>
      <tr>
        <td><?=$version->version_code?></td>
        <td><?=$version->version_name?></td>
        <td><?=$version->file_path?></td>
        <td><?=$version->content?></td>
        <td><?=$version->down_count?></td>
        <td>
            <?php if($version->android_url):?>
            <a href="<?=$version->android_url?>">下载</a>
            <?php else:?>
            <a href="/app/apk/down?f=<?=$version->file_path?>">下载</a>
            <?php endif;?>
        </td>
        <td>
            <a class="text-info btn btn-xs btn-default" title="编辑app版本"
               href="<?=Url::to(['/app/admin/version/edit','action'=>'update','id'=>$version->id])?>">
               <i class="fa fw fa-edit"></i> 编辑</a>

             <?php $msg = '您确认要删除app版本［'.$version->version_code.'］吗?';?>    
             <a class="ms-confirm btn btn-xs btn-default text-danger " data-message="<?=$msg?>"
               href="<?=Url::to(['/app/admin/version/del', 'id'=>$version->id])?>">
               <i class="fa fw fa-times"></i> 删除</a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>



    </div><!-- /.box-body -->
    
  </div><!-- /.box -->

</section><!-- /.content -->

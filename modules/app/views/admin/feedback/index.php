<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
// 共享给上一层
$this->params['pagination'] = $pagination;
?>

<section class="content-header">
  <h1>
      <i class="fa fa-fw fa-user"></i> <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin/site.html"><i class="fa fa-home"></i> 首页</a></li>
    <li class="action"><a href="<?=Yii::$app->request->url?>">App推送信息管理</a></li>
  </ol>
</section>

<section class="content">

  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
    </div>
    <div class="box-body no-padding">
      <table id="action-table" class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th width="50">反馈ID</th>
            <th width="80">邮件地址</th>
            
            <th width="80">店铺名</th>
            <th width="120">反馈内容</th>
            <th width="150">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($records as $info):?>
          <tr>
            <td><span class="text-primary small">[<?=sprintf('%05d',$info->id)?>]</span></td>
            <td><?=$info->email?></td>
            
            <td><code><?=$info->shop->name?></code></td>
            <td><?=$info->content?></td>
            <td class="sui-text-right">
              <a class="btn btn-xs btn-default text-primary ms-remote-form" data-size="large"
                 title="推送信息详情"
                 href="<?=Url::to(['/app/admin/feedback/info', 'id'=>$info->id])?>">
                <i class="fa fa-fw fa-edit"></i>
                查看详情</a>
                <a class="text-info ms-remote-form btn btn-xs btn-default" title="编辑推送信息"
               href="<?=Url::to(['/app/admin/feedback/edit','action'=>'update','id'=>$info->id])?>">
               <i class="fa fw fa-edit"></i> 编辑</a>
                <?php $msg = '您确认要删除推送信息';?>    
             <a class="ms-confirm btn btn-xs btn-default text-danger " data-message="<?=$msg?>"
               href="<?=Url::to(['/app/admin/feedback/del', 'id'=>$info->id])?>">
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

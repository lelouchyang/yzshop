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
            <th width="50">记录ID</th>
            <th width="80">channel ID</th>
            <th width="80">手机类型</th>
            <th width="80">发送时间</th>
            <th width="120">错误代码</th>
            <th width="120">错误消息</th>
            <th width="120">标题</th>
            <th width="150">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($records as $info):?>
          <tr>
            <td><span class="text-primary small">[<?=sprintf('%05d',$info->id)?>]</span></td>
            <td><?=$info->channel_id?></td>
            <td class="text-danger"><?=$info->mobile_type?></td>
            <td><code><?=$info->send_time?></code></td>
            <td><?=$info->error_code?></td>
            <td><?=$info->error_msg?></td>
            <td><?=$info->title?></td>
            <td class="sui-text-right">
              <a class="btn btn-xs btn-default text-primary ms-remote-form" data-size="large"
                 title="DEBUG信息详情"
                 href="<?=Url::to(['/app/admin/push/info', 'id'=>$info->id])?>">
                <i class="fa fa-fw fa-edit"></i>
                查看详情</a>
                
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

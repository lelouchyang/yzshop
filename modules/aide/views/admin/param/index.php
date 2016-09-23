<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
?>
<section class="content-header">
  <h1>
    <i class="fa fa-fw fa-home"></i>
    <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=Url::to(['/admin'])?>"><i class="fa fa-fw fa-home"></i> 首页</a></li>
    <li class="active"><?=$this->title;?></li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
  <a href="<?=Url::to(['/aide/admin/param/system'])?>" 
     class="btn btn-xs btn-default text-primary">
     <i class="fa fa-info"></i> 查看整站配置</a>
  <a href="<?=Url::to(['/aide/admin/param/edit', 'action'=>'add'])?>" 
     class="btn btn-xs btn-default text-red ms-remote-form" data-size="normal">
     <i class="fa fa-plus"></i> 添加新的配置</a>

      </div>
    </div>
    <div class="box-body no-padding">
  <table class="table table-bordered table-condensed" id="conf-box">
      <thead>
        <tr>
          <th width="100">键</th>
          <th width="150">值</th>
          <th width="100">类型</th>
          <th width="200">描述</th>
          <th width="100">操作</th>
        <tr/>
      </thead>
      <tbody>
        <?php foreach($params as $param):?>
         <tr>
           <td class="text-center text-middle">
             <code><?=$param->name;?></code>
           </td>

           <?php if($param->type == 'array'):?>
           <td style="padding:0px;">
            <table class="table table-condensed no-margin">
              <tbody>
                <?php foreach($param->realValue as $value):?>
                <tr>
                    <td class="w6"></td>
                    <td><span class="text-primary"><?=$value?></span></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
           </td>
           <?php elseif ($param->type == "dictory"):?>
           <td class="no-padding">
            <table class="table table-condensed table-borderd no-margin">
              <tbody>
                <?php foreach($param->realValue as $key=>$value):?>
                <tr>
                    <td class="w6"><code><?=$key;?></code></td>
                    <td><span class="text-primary"><?=$value;?></span></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
           </td>
           <?php else:?>
           <td style="padding-left:6em;">
            <span class="text-primary">
                <?=$param->value;?>
            </span>
           </td>
           <?php endif;?>
           <td class="text-center text-middle">
             <code><?=$param->type;?></code>
           </td>
           <td>
            <?=$param->des;?>
           </td>
           <td class="text-right text-middle">
            <a class="btn btn-xs btn-default ms-remote-form" data-size="normal"
               href="<?=Url::to(['/aide/admin/param/edit', 'action'=>'update', 'id'=>$param->id])?>">
              <i class="fa fa-fw fa-edit"></i> 编辑
            </a>
            <a class="btn btn-xs btn-default ms-confirm"
               href="<?=Url::to(['/aide/admin/param/delete','id'=>$param->id])?>">
              <i class="fa fa-fw fa-times"></i> 删除
            </a>
            </td>
         </tr>
        <?php endforeach;?>
      </tbody>
  </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

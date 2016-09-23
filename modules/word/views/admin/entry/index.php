<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
use app\mysite\widgets\upload\Affix;
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
      
      
      </div>
    </div>
    <div class="box-body no-padding">

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
          
          <th width="300">文件名</th>
          <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($records as $info):?>
      <tr>
        <td><?=$info->name?></td>
        <td>
        <?php $id  = $info->id;?>
        <?php $url = $info->url;?>    
             <a href="<?=Url::to(["/".$url])?>"
                    <i class="text-primary fa fa-edit"></i>
                    预览
                </a>
             
             <a href="<?=Url::to(['/admin/word/entry/edit','id'=>$id,'action'=>'update'])?>"
                    <i class="text-primary fa fa-edit"></i>
                    编辑
                </a>

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

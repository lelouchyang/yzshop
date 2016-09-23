<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
use app\mysite\widgets\upload\Affix;
?>

<section class="content-header">
  <h1>
    <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
    <li class="active">评论信息</li>
  </ol>
</section>

<section class="content">
  <div class="box no-border">
    <ul class="nav nav-tabs">
      <li>
        <a href="/admin/shop/info/edit?action=update&id=<?=$Shop->id?>"><i class="fa fa-fw fa-home"></i> <?=$Shop->name?></a>
      </li>
      <li>
         <a href="/admin/shop/goods.html?shop_id=<?=$Shop->id?>"><i class="fa fa-fw fa-barcode"></i> 商 品</a>
      </li>
      <li>
        <a href="/admin/order/info.html?shop_id=<?=$Shop->id?>"><i class="fa fa-fw fa-credit-card"></i> 订 单</a>
      </li>
      <li class="active">
        <a href="/admin/comment/entry.html?shop_id=<?=$Shop->id?>"><i class="fa fa-fw fa-commenting-o"></i> 评 论</a>
      </li>
      <li>
        <a href="/admin/order/bill.html?shop_id=<?=$Shop->id?>"><i class="fa fa-fw fa-calculator"></i> 结账信息汇总</a>
      </li>
      <li>
        <a href="/admin/sta/info.html?shop_id=<?=$Shop->id?>"><i class="fa fa-fw fa-bar-chart"></i> 统 计</a>
      </li>
    </ul>
    <div class="box-body no-padding">
      <div class="row">
        
        <div class="col-sm-9">

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
          <th width="50">ID</th>
          <th width="50">评论内容</th>
          <th width="200">评论时间</th>
          
          <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($records as $goods):?>
      <tr>
        <td class="text-mc"><small>[<?=$goods->id?>]</small></td>
        <td class="text-mc"><b><?=$goods->content?></b></td>
        <td class="text-mc"><b><?=$goods->created?></b></td>
        <td class="text-mc">
        <?php $id = $goods->id;?>
            <a class="text-info ms-remote-form btn btn-xs btn-default" title="编辑评论"
               href="<?=Url::to(['/comment/admin/entry/edit','action'=>'update','id'=>$id])?>">
               <i class="fa fw fa-edit"></i> 编辑</a>
             <?php $msg = '您确认要删除评论［'.$goods->content.'］吗?';?>    
             <a class="ms-confirm btn btn-xs btn-default text-danger " data-message="<?=$msg?>"
               href="<?=Url::to(['/comment/admin/entry/del', 'id'=>$id])?>">
               <i class="fa fw fa-times"></i> 删除</a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>

        </div>
      </div>
    </div>
    <div class="box-footer text-center">
  <?=$pagination?>
    </div>
  </div>
</section>

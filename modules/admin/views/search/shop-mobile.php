<?php 
$User = $Shop->user;
?>
<div class="row">
 <div class="col-sm-12">
   <table class="table table-condensed" style="border:none;">
    <tr style="border-top:none;">
      <td colspan="4" class="text-center">
         <a class="btn btn-xs btn-default" 
            href="/admin/shop/info/edit?action=update&id=<?=$Shop->id?>">
            <i class="text-danger fa fa-home"></i>
            店 铺
         </a>
         <a class="btn btn-xs btn-default" 
            href="/admin/shop/goods.html?shop_id=<?=$Shop->id?>">
            <i class="text-danger fa fa-fw fa-barcode"></i>
            商 品
         </a>
         <a class="btn btn-xs btn-default" 
            href="com/admin/order/info.html?shop_id=<?=$Shop->id?>">
            <i class="text-danger fa fa-fw fa-credit-card"></i>
            订 单
         </a>
         <a class="btn btn-xs btn-default" href="/admin/comment/entry.html?shop_id=<?=$Shop->id?>">
            <i class="text-danger fa fa-fw fa-commenting-o"></i>
            评 论
         </a>
      </td>
    </tr>
    <tr>
      <td><b>手机号码：</b></td>
      <td><code><?=$User->mobile?></code></td>
      <td><b>注册时间：</b></td>
      <td><code><?=date('Y年m月d日 H点i分',strtotime($User->created))?></code></td>
    </tr>

    <tr>
       <td><b>店铺名称：</b></td>
       <td> 『<?=$Shop->name?>』</td>
       <td><b>行业：</b></td>
       <td><?=$Shop->shopType->name;?></td>
    </tr>

    <tr>
      <td><b>相关医院：</b></td>
      <td colspan="3">
        <?php foreach($Shop->hospitals as $hos):?>
        <span class="label label-info"><?=$hos->name?></span>
        <?php endforeach;?>
      </td>
    </tr>

  </table>
 </div>
</div>

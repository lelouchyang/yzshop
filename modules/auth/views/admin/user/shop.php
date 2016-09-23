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
    <li class="action"><a href="<?=Yii::$app->request->url?>"><?=$this->title;?></a></li>
  </ol>
</section>

<section class="content">

  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
         <!--
          <a href="<?=url::toRoute(['/auth/admin/user/edit', 'action'=>'add'])?>" 
             class="btn btn-sm btn-primary">
             <i class="fa fa-fw fa-user-plus"></i>  添加用户</a>
         -->
      </div>
    </div>
    <div class="box-body no-padding">
      <div class="well well-sm well-search-form" style="margin:10px;">
        <form class="form-inline" method="get">
          <div class="form-group">
            <label for="">按手机号 </label>
            <input type="text" name="mobile" value="<?=ifelse(isset($get['mobile']), $get['mobile'], '')?>" placeholder="手机号">
          </div>
          <button type="submit" class="btn btn-default btn-xs">
              <i class="fa fa-fw fa-search"></i>搜索</button>
        </form>
      </div>
      <div class="col-sm-12">
        <span class="">共有商户:<span class="text-danger"><?=$totalAmount?></span> 人</span>
      </div>
      <table class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th width="50">ID</th>
            <th width="120">手机</th>
            <th width="100">店铺</th>
            <th width="60">店主</th>
            <th width="200">相关医院</th>
            <th width="60">账号状态</th>
            <th width="120">注册时间</th>
            <th width="60"><i class="fa fa-fw fa-gear"></i> 操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($records as $user):?>
          <tr>
            <td><span class="text-primary small">[<?=sprintf('%05d',$user->id)?>]</span></td>
            <td class="text-danger"><?=$user->mobile?></td>
            <td>
                <?php if($user->shop):?>
                <a href="/admin/shop/info/edit?action=update&id=<?=$user->shop->id?>" 
                       class="btn btn-xs btn-default">
                            <i class="fa fa-external-link"></i>
                            <?=$user->shop->name?>
                    </a>
                <?php else:?>
                    <span class="small text-muted">没有添加店铺</span>
                <?php endif;?>
            </td>
            <td>
                <?php if($user->shop):?>
                <strong><?=$user->shop->contact_name;?></strong>
                <?php endif;?>
            </td>
            <td>
                <?php if($user->shop):?>
                <?php $hospitals = $user->shop->hospitals;?>
                <?php foreach($hospitals as $hos):?>
                    <span class="label label-default"><?=$hos->name?></span>
                <?php endforeach;?>
                <?php else:?>
                <small>没有关联医院</small>
                <?php endif;?>
            </td>
            <td><?=$user->status_map[$user->status]?></td>
            <td><small class="text-danger"><?=cleanDt($user->created);?></small></td>
            <td class="text-right">
                <a class="btn btn-xs btn-danger ms-confirm" 
                data-message="清除对象: [<?=$user->mobile?>]<br />该操作将清除商户所有相关数据,地推初期和测试使用！"
                href="/admin/auth/user/clear-shop-user?id=<?=$user->id?>">物理清除</a>
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

<?php

?>
<section class="content-header">
  <h1>
    辽宁口腔医院后台管理
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin.html"><i class="fa fa-dashboard"></i> 首页</a></li>
  </ol>
<ction>

<section class="content">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="text-muted fa fa-fw fa-folder"></i> 请选择左侧列表的具体功能进行操作</h3>
      <div class="pull-right">



      </div>
    </div>
    <div class="box-body">
        
    </div>
  </div>

  

  

<script type="text/javascript">
$(function(){

    var beforeFormLoadContent = 
    '<div style="height:150px;padding-top:2.5em;text-align:center">' +
        '<i style="font-size:4em;" class="text-gray fa fa-spinner fa-spin"></i>'+
        '<p class="text-black" style="margin-top:1em;">正在加载....<p>'+
    '</div>';



    $('#searchShop').on('submit', function(e){
        e.preventDefault();
        var $this = $(this);
        var shopId = $.trim($this.find('input[name=shop_id]').val());
        if ( !shopId ) return;
        // 弹出窗口
        var $me = bootbox.dialog({
          message: beforeFormLoadContent,
          title: '<i class="fa fa-fw fa-list-alt "></i> 查找商户／商铺',
          animate: true,
        });

        // 加载内容
        var datas = { 'shop_id' : shopId };
        $.get('/adminarch/shop-mobile', datas, function(xhr){
            $me.find('div.bootbox-body').html(xhr);
        }, 'html')
    });
});
</script>
<section><!-- /.content -->
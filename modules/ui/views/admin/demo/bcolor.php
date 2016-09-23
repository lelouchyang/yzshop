<?php 
use \app\mysite\helpers\StringHelper;
?>
<?php
/* @var $this yii\web\View */
?>
<div class="content-header">
  <div class="sui-row-fluid">
    <h2 class="span6">
      <i class="fa fa-fw fa-home"></i>
      后台页面DEMO
    </h2>
    <ul class="span6 sui-breadcrumb sui-text-right">
       <li><a href="/"><i class="fa fa-fw fa-home"></i> 首页</a></li>
       <li><a href="#">页面一</a></li>
       <li class="active"><a href="#">页面二</a></li>
    </ul>
  </div>
</div>
<div class="content-inner">
    <form class="sui-form">
        <div class="row-fluid">
        <?php foreach($urls as $url):?>
            <?php 
            if ( StringHelper::endsWith($url, '400.png')) {
                    $style = "background:url($url) repeat-x 50% 50%;";
            } else {
                    $style = "background:url($url);";
            }
            ?>
            <div class="span2" >
                <div style="<?=$style;?>border:1px solid #333;margin-bottom:10px;height:100px;"></div>
                <p><input type="text" style="width:95%;" value="<?=$style?>" /></p>
            </div>
        <?php endforeach;?>
        </div>
    </form>
</div>

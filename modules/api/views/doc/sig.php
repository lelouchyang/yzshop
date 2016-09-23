<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
?>


<div class="row">
  <div class="col-sm-12" style="padding-top:2em;">
    <?php include('nav.php')?>
  </div>


  <div class="col-sm-12">
    <h4>[可用TOKEN]</h4>
    <p class="text-primary">80eb88f2b208f0cb97d09a08d6429633</p>
  </div>

  <div class="col-sm-12" style="margin-top:10px;">
    <div style="font-size:1.2em;">
    <h4>一. 签章规则</h4>
    <hr />
    <p class="text-danger">
        1. 测试用: 
            <?php 
                dump([
                    'apiKey' => 'xn16flo5uak3axj1y9yt8z8cwuy3vf4n',
                    'sharedSecret'=> 'y2wz7fetvrjzddk1izql44gcx046ak76'
                ]);
            ?>
    </p>
    <p class="text-danger">
        2. 参数组成的数组按键值排序
    </p>
    <p class="text-danger">
        3. 链接字符串为 $key1+$value1+$key2+$value2 .... 
    </p>
    <p class="text-danger">
        4. 加密字符串生成[签章sig], md5('上一步字符串'+$sharedSecret)
    </p>
    <p class="text-danger">
        5. token与上传文件参数不参与签章计算
     </p>
    </div>
  </div>

  <div class="col-sm-12">
    <div style="font-size:1.2em">
      <h4>二. Api返回［错误码］说明</h4>
      <hr />
    </div>
  </div>


  <div class="col-sm-12">
    <div style="font-size:1.2em">
    <h4>三.订单状态说明[order_info上字段]</h4>
    <hr />
      <p><code>is_cod</code> 货到付款 <code>1</code> 是  <code>0</code> 否</p>
      <p><b>订单状态</b></p>
      <ul> 
        <li>
         <b>货到付款的</b>
         <p>
            <code>pro_status</code>  
            <code>1</code> 下单状态 
            <code>2</code> 直接进入2 
            <code>4</code> 接单状态［配送中］
            <code>6</code> 完成状态［意味着已经收款］ 
        </p>
        </li>
        <li> 
        <b>在线支付的</b>
        <p>
            <code>pro_status</code> 
            <code>1</code> 下单状态 
            <code>2</code> 支付成功 
            <code>4</code> 接单状态［配送中］
            <code>6</code> 完成状态［意味着已经收款］ 
        </p>
        </li>
      </ul>
   </div>
  </div>
</div>


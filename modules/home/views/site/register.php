<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="register-form">

<form class="sui-form form-horizontal" method="POST" >
  <div class="control-group">
    <label class="control-label"><span style="padding-right:2em;">账</span>号：</label>
    <div class="controls">
      <input type="text" class="input-large" name="username" placeholder="账号" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"><span style="padding-right:2em">密</span>码：</label>
    <div class="controls">
      <input type="password" name="password" class="input-large" placeholder="密码" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">重复密码：</label>
    <div class="controls">
      <input type="password" name="repassword" class="input-large" placeholder="重复密码" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls">
      <button type="submit" class="sui-btn btn-primary">注册</button>
      <button type="reset" class="sui-btn">重置</button>
    </div>
  </div>
</form>

</div>

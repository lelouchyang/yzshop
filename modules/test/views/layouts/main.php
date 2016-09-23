<?php
use yii\helpers\Html;
use \app\mysite\helpers\Url;
\app\modules\test\assets\Test::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>iTomb II</title>
 <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?=$content ?>
<div id="_ms-remote-form" tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
        <h4 class="modal-title">远程表单</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer sui-text-right">
        <button class="sui-btn btn-primary">提交</button>
        <button class="sui-btn btn-danger">取消</button>
      </div>
    </div>
  </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
use app\modules\admin\assets\Admin;

Admin::register($this);
?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
?>
<ul class="nav nav-tabs">
<li role="presentation" class="<?=ifelse(codeName('api/doc/shop'), 'active')?>">
      <a href="<?=Url::to(['/api/doc/shop'])?>" style="font-size:1.1em;">
        <i class="text-muted fa fa-fw fa-file-text<?=ifelse(codeName('api/doc/shop'), '','-o')?>"></i>
        API文档(商户端)
      </a>
  </li>
  <li role="presentation" class="<?=ifelse(codeName('api/doc/client'), 'active')?>">
      <a href="<?=Url::to(['/api/doc/client'])?>" style="font-size:1.1em;">
        <i class="text-muted fa fa-fw fa-file-text<?=ifelse(codeName('api/doc/customer'), '','-o')?>"></i>
        API文档(客户端)
      </a>
  </li>
  <li role="presentation" class="<?=ifelse(codeName('api/doc/sig'), 'active')?>">
     <a href="<?=Url::to(['/api/doc/sig'])?>" style="font-size:1.1em;">
        <i class="text-muted fa fa-fw fa-file-text<?=ifelse(codeName('api/doc/sig'), '','-o')?>"></i>
        项目相关说明 
     </a>
   </li>
  <li role="presentation" class="<?=ifelse(codeName('api/doc/dbshop'), 'active')?>">
      <a href="<?=Url::to(['/api/doc/dbshop'])?>" style="font-size:1.1em;">
        <i class="text-muted fa fa-fw fa-file-text<?=ifelse(codeName('api/doc/dbshop'), '', '-o')?>"></i>
        数据字典(商户平台)
      </a>
  </li>
  <li role="presentation" class="<?=ifelse(codeName('api/doc/dbhospital'),'active')?>">
    <a href="<?=Url::to(['/api/doc/dbhospital'])?>" style="font-size:1.1em;">
      <i class="text-muted fa fa-fw fa-file-text<?=ifelse(codeName('api/doc/dbhospital'), '', '-o')?>"></i>
      数据字典(医院平台)
    </a>
  </li>
</ul>

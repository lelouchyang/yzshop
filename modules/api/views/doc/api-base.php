<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
?>
<style type="text/css">
span.field_name {
    display:inline-block;
    width:4em;
}
</style>
<div class="row">
   <div class="col-sm-12" style="padding-top:2em;">
     <?php include('nav.php')?>
   </div>
   <div class="col-sm-12">
      <ul class="nav nav-tabs  nav-tabs-google" role="tablist"> 
        <li role="presentation" class="active">
           <a href="#api-all" id="api-all-tab" role="tab" data-toggle="tab" aria-controls="api-all" aria-expanded="true">所有</a>
        </li> 
         <?php foreach($apiGroup as $key=>$group):?>
         <li role="presentation" class="">
            <a href="#api-<?=$key?>" role="tab" id="<?=$key?>-tab" 
               data-toggle="tab" aria-controls="api-<?=$key?>" aria-expanded="false"><?=$key?></a>
         </li> 
         <?php endforeach;?>
      </ul> 

      <div class="tab-content"> 
         <div role="tabpanel" class="tab-pane active in" id="api-all" aria-labelledby="api-all-tab"> 
            <?php include('api-all.php')?>
         </div>
         <?php foreach($apiGroup as $key=>$group):?>
         <div role="tabpanel" class="tab-pane" id="api-<?=$key?>" aria-labelledby="api-<?=$key?>-tab"> 
            <?php include('item.php')?>
         </div>
         <?php endforeach;?>
      </div>
   </div> 
</div>


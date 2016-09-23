<?php
use app\mysite\helpers\Url;
?>
<ul class="sui-nav">
    <?php foreach($menus as $panelId=>$panel):?>
    <li id="ms-admin-panel-<?=$panelId?>" 
        class="ms-admin-nav-item <?=$panelId==$currPanelId? 'active':'';?>">
        <a href="<?=Url::to(['/admin.html', 'panel_id'=>$panelId]);?>">
          <i class="fa fa-fw <?=$panel['icon']?>"></i> <?=$panel['name']?>
        </a>

        <div class="ms-admin-panel-box" rel="ms-admin-panel-<?=$panelId?>" style="display:none;">
            <?php if(isset($panel['modules'])):?>
                <?php foreach($panel['modules'] as $module):?>
                <ul class="unstyled sui-row-fluid">
                    <li class="span12"><h4><i class="fa fa-fw fa-folder-o"></i> <?=$module['name']?></h4>
                        <?php if(isset($module['children'])):?>
                        <ul class="unstyled inline">
                            <?php foreach($module['children'] as $menu):?>
                            <li class="span3">
                                <a href="<?=$menu['url']?>"><i class="fa fa-fw fa-circle-thin"> </i><?=$menu['name']?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <?php endif;?>
                    </li>
                </ul>
                <?php endforeach;?>
            <?php endif;?>
        </div>

    </li>
    <?php endforeach;?>
</ul>

<div class="pull-right nav-avatar" >
    <span style="color:#f1f1f1"><a style="color:white;" href="<?=Url::to(['/']);?>">网站前台</a> | </span>
    <span style="color:#f1f1f1;">当前登陆:</span>
    <span style="color:#f1f1f1;"><?=Yii::$app->auth->username;?> | </span>
    <span style="color:#f1f1f1;"><a style="color:white" href="<?=Url::to(['logout']);?>">退出</a></span>
    <a href="#">
        <img style="width:38px;" src="/media/admin/images/avatar5.png" class="img-circle">
    </a>
</div>

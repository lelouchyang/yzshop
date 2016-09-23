<?php
use app\mysite\helpers\Url;
?>
<ul class="sidebar-menu">
<li class="header">管理模块导航</li>
<?php foreach($menus as $menu):?>
<li class="treeview <?php if($menu['module_id'] == $moduleId):?>active<?php endif;?> ">
  <a href="#">
  <i class="text-muted fa fa-<?=ifelse($menu['icon'], $menu['icon'], 'folder-o')?>"></i> 
    <span class="fzk"><?=$menu['name']?></span> 
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <?php foreach($menu['children'] as $child):?>
    <li class="<?php if($child['action_id'] == $actionId):?>active<?php endif;?>">
        <a href="<?=$child['url']?>">
        <i class="text-muted fa fa-circle-o fzk"></i> <?=$child['name'];?> </a>
    </li>
    <?php endforeach;?>
  </ul>
</li>
<?php endforeach;?>
</ul>

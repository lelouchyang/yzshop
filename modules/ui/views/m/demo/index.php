<?php
use \app\mysite\helpers\Url;
?>
<div class="page">
  <!-- 标题栏 -->
  <header class="bar bar-nav">
    <a class="icon icon-me pull-left open-panel"></a>
    <h1 class="title">标题</h1>
  </header>

  <!-- 工具栏 -->
  <nav class="bar bar-tab">
    <a class="tab-item active" href="<?=Url::to('/ui/m/demo/index');?>">
      <span class="icon icon-home"></span>
      <span class="tab-label">首页</span>
    </a>
    <a class="tab-item" href="<?=Url::to('/ui/m/demo/mobile-icon');?>">
      <span class="icon icon-star"></span>
      <span class="tab-label">移动图标</span>
    </a>
    <a class="tab-item" href="http://m.sui.taobao.org/demos/">
      <span class="icon icon-settings"></span>
      <span class="tab-label">官方演示</span>
    </a>
  </nav>

  <!-- 这里是页面内容区 -->
  <div class="content">
    <div class="content-block">这里是content</div>
  </div>
</div>

<!-- popup, panel 等放在这里 -->
<div class="panel-overlay"></div>
<!-- Left Panel with Reveal effect -->
<div class="panel panel-left panel-reveal">
  <div class="content-block">
    <p>这是一个侧栏</p>
    <p></p>
    <!-- Click on link with "close-panel" class will close panel -->
    <p><a href="#" class="close-panel">关闭</a></p>
  </div>
</div>

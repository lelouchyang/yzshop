<?php
use \app\mysite\helpers\Url;
?>

<!-- page集合的容器，里面放多个平行的.page，其他.page作为内联页面由路由控制展示 -->
    <div class="page-group">
        <!-- 单个page ,第一个.page默认被展示-->
        <div class="page">
            <!-- 标题栏 -->
            <header class="bar bar-nav">
                <a class="icon icon-me pull-left open-panel"></a>
                <h1 class="title">我的</h1>
            </header>
            <!-- 工具栏 -->
            <nav class="bar bar-tab">
                <a class="tab-item external" href="#">
                    <span class="icon ion-ios-list-outline"></span>
                    <span class="tab-label">订单</span>
                    <span class="badge">16</span>
                </a>
                <a class="tab-item external" href="#">
                    <span class="icon ion-ios-box-outline"></span>
                    <span class="tab-label">商品</span>
                </a>
                <a class="tab-item external" href="#">
                    <span class="icon ion-ios-pie-outline"></span>
                    <span class="tab-label">统计</span>
                </a>
                <a class="tab-item external active" href="/m.html">
                    <span class="icon ion-ios-person"></span>
                    <span class="tab-label">我的</span>
                </a>
            </nav>

            <!-- 这里是页面内容区 -->
            <div class="content">
 <div class="card" style="margin:0px;">
    <div class="card-content">
      <div class="card-content-inner" style="text-align:center">
            <img style="border-radius: 50%;width:90px;height:90px;" src="/media/libs/adminlte/img/user8-128x128.jpg">
            <br />
            <p style="text-align:center">测试账号</p>
      </div>
    </div>
  </div>
  <div class="list-block">
    <ul>
      <a href="/m/shop/info/index">
      <li class="item-content item-link">
        <div class="item-media"><i class="icon ion-ios-home-outline"></i></div>
        <div class="item-inner">
          <div class="item-title">我的店铺</div>
        </div>
      </li>
      </a>
    </ul>
  </div>
  <div class="list-block">
    <ul>
      <li class="item-content item-link">
        <div class="item-media"><i class="icon ion-ios-paperplane-outline"></i></div>
        <div class="item-inner">
          <div class="item-title">通知推送</div>
          <div class="item-after">
              <label class="label-switch">
                <input type="checkbox">
                <div class="checkbox"></div>
              </label>
          </div>
        </div>
      </li>
      <li class="item-content item-link">
        <div class="item-media"><i class="icon ion-ios-alarm-outline"></i></div>
        <div class="item-inner">
          <div class="item-title">震动提醒</div>
          <div class="item-after">
              <label class="label-switch">
                <input type="checkbox">
                <div class="checkbox"></div>
              </label>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="list-block">
    <ul>
      <li class="item-content item-link">
        <div class="item-media"><i class="icon ion-ios-close-outline"></i></div>
        <div class="item-inner">
          <div class="item-title">清除缓存</div>
          <div class="item-after">16.4M</div>
        </div>
      </li>
      <li class="item-content item-link">
        <div class="item-media"><i class="icon ion-ios-albums-outline"></i></div>
        <div class="item-inner">
          <div class="item-title">版本更新</div>
          <div class="item-after">已是最新版本</div>
        </div>
      </li>
      <li class="item-content item-link">
        <div class="item-media"><i class="icon ion-ios-gear-outline"></i></div>
        <div class="item-inner">
          <div class="item-title">关于</div>
        </div>
      </li>
    </ul>
  </div>
            </div>
        </div>

        <!-- 其他的单个page内联页（如果有） -->
        <div class="page">...</div>
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

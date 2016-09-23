<div class="content-block-title">商户注册</div>
<div class="content-block">
 <div class="list-block">
    <ul>
     <?php foreach($hospitals as $hos):?>
      <li class="item-content">
        <div class="item-media"><i class="icon icon-f7"></i></div>
        <div class="item-inner">
        <div class="item-title"><?=$hos->name;?></div>
        </div>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
</div>

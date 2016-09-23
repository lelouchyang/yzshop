<?php 
use \app\mysite\helpers\StringHelper;
?>

<form class="sui-form">
<div class="sui-row-fulid">
<?php foreach($urls as $url):?>
    <?php 
    if ( StringHelper::endsWith($url, '400.png')) {
            $style = "background:url($url) repeat-x 50% 50%;";
    } else {
            $style = "background:url($url);";
    }
    ?>
    <div class="span2" >
        <div style="<?=$style;?>border:1px solid #333;margin-bottom:10px;height:100px;"></div>
        <p><input type="text" style="width:95%;" value="<?=$style?>" /></p>
    </div>
<?php endforeach;?>
</div>
</form>

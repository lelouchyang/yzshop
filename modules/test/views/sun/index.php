<?php
$colors = ['00', '33', '66', '99', 'aa', 'cc', 'ee', 'ff'];
?>
<div class="sui-row-fulid">
    <?php foreach($colors as $r):?>
        <?php foreach($colors as $g):?>
            <?php foreach($colors as $b):?>
                <?php $c=implode('', [$r,$g, $b]);?>
                <div class="span2">
                    <?=\app\mysite\helpers\Html::imgHolder('100','100',['bg'=>$c,'text'=>'永安'], ['style'=>'margin:10px;border-radius:50%;']);?>
                </div>
            <?php endforeach;?>
        <?php endforeach;?>
    <?php endforeach;?>
</div>

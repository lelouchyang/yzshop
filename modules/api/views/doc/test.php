<?php 
use \app\mysite\helpers\ArrayHelper;
?>
<h3>Api测试页面</h3>
<small class="text-primary">
<a href="<?=$resp->url?>"><?=$resp->url?></a>
</small>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th width="100">方法：</th>
                <td><?=$post['actionMethod']?></td>
                <th width="100">返回：</th>
                <td><code><?=$post['actionReturn']?></code></td>
            </tr>
            <tr>
                <th width="100">描述：</th>
                <td colspan="3"><code><?=$post['actionDesc']?></code></td>
            </tr>
            <tr>
                <th>参数：</th>
                <td colspan="3">
                    <?php dump($params);?>
                </td>
            </tr>
            <tr>
                <th>编码后参数：</th>
                <td colspan="3">
                    <?php dump($datas);?>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-sm-12"><hr /></div>
    <div class="col-sm-12">
        <?php if( in_array($resp->status_code,['500','404']) ): ?>
            <?=$resp->body;?>
        <?php else:?>
            <?php dump(ArrayHelper::toArray(json_decode($resp->body)));?>
        <?php endif;?>
    </div>
</div>


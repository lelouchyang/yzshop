<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
$tables = Yii::$app->dbyz->schema->getTableSchemas();
?>

<div class="row">
  <div class="col-sm-12" style="padding-top:2em;">
    <?php include('nav.php')?>
  </div>

  <div class="col-sm-12">

    <div class="row">
        <div class="col-sm-9">
          <?php $i=1;?>
          <?php foreach($tables as $table):?>
              <div class="box box-success">
                <a name="_<?=$table->name?>"></a>
                <div class="box-header">
                <h3 class="box-title">
                    表 - [ <strong><?=$table->name;?></strong>]
                </h3>
                </div>
                <div class="box-body no-padding">
                   <table class="table table-condensed table-striped table-bordered">
                      <thead>
                        <tr>
                          <th colspan="4" class="text-warning">
                            <code># <?=sprintf('%03d', $i)?></code> <?=getTableComment($table->name, 'yunzhi120');?>
                          </th>
                        </tr>
                        <tr>
                          <th>列名</th>
                          <th>备注</th>
                          <th>类型</th>
                          <th>缺省</th>
                         </tr>
                      </thead>
                      <tbody>
                      <?php foreach($table->columns as $column):?>
                      <tr>
                        <th style="width:12em;"><code><?=$column->name?></code></th>
                        <th style="width:20em" class="text-success"><?=$column->comment?>

                        </th>
                        <td class="small"><?=$column->dbType?></td>
                        <td class="small"><?=$column->defaultValue?></td>
                      </tr>
                      <?php endforeach;?>
                      </tbody>
                   </table>
                </div><!-- /.box-body -->
              </div>
          <?php $i++;?>
          <?php endforeach;?>
        </div>

        <div class="col-sm-3" style="padding-top:4em;">
            <div class="list-group">
                <?php foreach($tables as $table):?>
                <p class="list-group-item">
                  <a href="#_<?=$table->name?>">
                   <i class="text-muted fa fa-table"></i> <strong class="text-info"><?=$table->name;?></strong>
                  </a>
                </p>
               <?php endforeach;?>
            </div>
        </div>
  </div>
</div>


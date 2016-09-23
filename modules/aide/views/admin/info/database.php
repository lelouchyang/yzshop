<?php
/* @var $this yii\web\View */
use app\mysite\helpers\Url;
$this->title = '数据表信息';
$tables = Yii::$app->$db->schema->getTableSchemas();


?>
<section class="content-header">
  <h1>
      <i class="fa fa-fw fa-home"></i>
      <?=$this->title;?>
  </h1>
  <ol class="breadcrumb">
   <li><a href="/"><i class="fa fa-fw fa-dashboard"></i> 首页</a></li>
   <li class="active"><a href="#"><?=$this->title;?></a></li>
  </ol>
</section>

<section class="content">

      
    <div class="box box-solid">
        <div class="box-header with-border">
        <h3 class="box-title">共<code><?=count($tables)?></code>个表</h3>
         </div>
        <div class="box-body">
    <div class="row">
        <div class="col-sm-9">
          <?php foreach($tables as $table):?>
              <div class="box box-success">
                <a name="_<?=$table->name?>"></a>
                <div class="box-header">
                <h3 class="box-title">
表 [ <strong><?=$table->name;?></strong>]
                </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" 
                            data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                   <table class="table table-condensed table-striped table-bordered">
                      <thead>
                        <tr>
                          <th colspan="4" class="text-warning">
                            # <?=getTableComment($table->name, $dbName);?>
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
          <?php endforeach;?>
        </div>

        <div class="col-sm-3">
            <ul class="nav nav-stacked nav-stacked-thin">
                <?php foreach($tables as $table):?>
                <li class="">
                  <a href="#_<?=$table->name;?>">
                    <i class="fa fa-table"></i> <strong class="text-success"><?=$table->name;?></strong>
                  </a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>

</div>
</div>
</div>



</section><!-- /.content -->

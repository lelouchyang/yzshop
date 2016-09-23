<div class="row" style="margin-top:10px;">

  <div class="col-sm-3">
     <div class="list-group">
      <?php $i=1;?>
      <?php foreach ($group as $name=>$info):?>
      <p class="list-group-item">
          <?php if($info['over'] == 1):?>
          <span class="pull-right"><i class="fa fa-fw fa-check"></i></span>
          <?php endif;?>
          <strong> 
              <a href="#item-<?=$name?>">
                <span class="text-info"><?=sprintf("%02d - ", $i);?></span>
                <span class="text-info"> <?=$name?></span>
              </a>
          </strong>
         <br /> <b class="text-muted"><?=$info['desc']?> </b>
      </p>
      <?php $i++;?>
      <?php endforeach;?>
     </div>
  </div>

  <div class="col-sm-9">

     <?php $i=1;?>
     <?php foreach($group as $name=>$info):?>
      <a name="item-<?=$name?>"></a>
     <?php 
     $className = $info['over'] == 1? 'bg-info':'bg-danger'
     ?>
     <div class="<?=$className?>" style="padding:0.5em;margin-bottom:5px;">
        <h4>
        <span class="text-info"><?=sprintf("%02d - ", $i);?></span>
        <?php
         $faIcon = $info['over'] == 1? 'fa-check-circle-o':'fa-times-circle-o'
         ?>
         <i class="fa fa-fw <?=$faIcon?>"></i>
         地址:</span> <?=$info['url']?></code>
        </h4>
     </div>
     <div class="row">
         <div class="col-sm-12">
            <span class="field_name">方法:</span> <code><?=strtoupper($info['method'])?></code>
        </div>
     </div>
     
     <div class="row">
         <div class="col-sm-12">
            <span class="field_name">描述: </span>
            <code><?=$info['desc']?></code>
        </div>
     </div>
     <div class="row">
       <div class="col-sm-12">
           <span class="field_name">返回:</span> <code><?=$info['return']?></code>
       </div>
     </div>
     <hr />
     <form class="form-horizontal" action="/api/doc/test" method="post">
         <input type="hidden" name="actionMethod" value="<?=$info['method']?>" />
         <input type="hidden" name="actionUrl" value="<?=$info['url']?>" />
         <input type="hidden" name="actionDesc" value="<?=$info['desc']?>" />
         <input type="hidden" name="actionReturn" value="<?=$info['return']?>" />

         <?php if( count($info['params']) ): ?>
          <?php foreach($info['params'] as $field):?>
          <div class="form-group">
          <label for="" class="col-sm-3 control-label"><?=$field['field']?></label>
            <div class="col-sm-8">
            <input name="params[<?=$field['field']?>]" type="<?=$field['type']?>" 
                   class="form-control" placeholder="<?=$field['desc']?>">
            </div>
          </div>
          <?php endforeach;?>
          <?php endif;?>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
              <button type="submit" class="btn btn-sm btn-success">提交</button>
            </div>
          </div>
      </form>
     <hr />
     <?php $i++;?>
     <?php endforeach;?>

   </div>
</div> 

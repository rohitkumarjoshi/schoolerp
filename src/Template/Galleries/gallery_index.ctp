<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Gallery View </label>
            </div>
            <div class="box-body">
                <div class="row" style="padding-top:10px">
                    <?= $this->Form->create('dsad',['id'=>'ServiceForm','type'=>'file']) ?>
                        <div class="col-md-4">
                            <label class="control-label"> Select </label>
                            <?php echo $this->Form->control('gallery_id',[
                            'label' => false,'class'=>'form-control gallery_id','empty'=>'Select All','options' => $events]);?>
                        </div> 
                        <div class="col-md-4">
                            <?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-primary search','style'=>'margin-top: 25px;']); ?>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
                <span class="help-block"></span>
                <div class="row" style="padding-top:10px">
                <?php
                if(!empty($galleryData)){
                    $s=1;
                    foreach ($galleryData as $key => $galleryDatas) {
                        //pr($galleryDatas);
                        ?>
                        <div class="col-md-3" style="padding-top:10px">
                            <table style="text-align:center">
                                <tr><td><?= $this->Html->image($cdn_path.'/'.$galleryDatas->file_path,['style'=>  'margin-top: 0px;height: 150px;align-content: center; background-color: #f9eded00 !important;width: 150px;']); ?></td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td><a class=" btn btn-danger btn-sm" data-target="#deletemodal<?php echo $galleryDatas->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a></td></tr>
                            </table>
                            
                                <div id="deletemodal<?php echo $galleryDatas->id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md" >
                                    <?= $this->Form->create('',['url'=>['controller'=>'Galleries','action'=>'delete',$galleryDatas->id]]) ?>
                                            <div class="modal-content">
                                              <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" >
                                                        Stay Attention
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                <h4 class="modal-title">
                                                    Are you sure you want to remove this Image ?
                                                    </h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-sm btn-info">Yes</button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div> 
                        </div>
                        <?php  
                        if($s==4){echo'<div class="col-md-12"><hr></hr></div>'; $s=0;}
                        $s++;
                    }

                }

                 ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php
$js='
$(document).ready(function() { 
    
    

     
});
   
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
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
                            'label' => false,'class'=>'form-control gallery_id','empty'=>'Select...','options' => $events]);?>
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
                        ?>
                        <div class="col-md-3" style="padding-top:10px">
                            <table style="text-align:center">
                                <tr><td><?= $this->Html->image($cdn_path.'/'.$galleryDatas->file_path,['style'=>  'margin-top: 0px;height: 150px;align-content: center; background-color: #f9eded00 !important;width: 150px;']); ?></td></tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
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
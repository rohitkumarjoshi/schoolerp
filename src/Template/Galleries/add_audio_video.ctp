
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Add Audio & Video </label>
            </div>
            <div class="box-body">
                <div class="form-group">                       

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab">
                            Audio </a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab">
                            Video </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            <?= $this->Form->create($gallery,['id'=>'ServiceForms','type'=>'file']) ?>
                            <div class="row" style="padding-top:10px">
                                    <div class="col-md-6">
                                        <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('title',[
                                        'label' => false,'class'=>'form-control','placeholder'=>'Title','type'=>'text','required']);?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label"> Audio <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('cover_image',[
                                        'label' => false,'class'=>'','placeholder'=>'Date','type'=>'file','required']);?>
                                    </div>
                                </div>
                                <div class="row" style="padding-top:5px">
                                    <div class="col-md-6">
                                        <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('description',[
                                        'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>2,'required']);?>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="control-label"> Shareable</label>
                                         <?= $this->Form->control('shareable', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','value'=>1])?>
                                    </div>
                                </div>
                             
                            <div class="box-footer">
                                <div class="row">
                                    <center>
                                        <div class="col-md-12">
                                            <div class="col-md-offset-3 col-md-6">  
                                                <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member','name'=>'oldGallery']); ?>
                                            </div>
                                        </div>
                                    </center>       
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="tab-pane fade" id="tab_1_2">
                            <?= $this->Form->create($gallery,['id'=>'ServiceForm','type'=>'file']) ?>
                                <div class="row" style="padding-top:10px">
                                    <div class="col-md-6">
                                        <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('title',[
                                        'label' => false,'class'=>'form-control','placeholder'=>'Title','type'=>'text','required']);?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label"> Video <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('cover_image',[
                                        'label' => false,'class'=>'form-control','placeholder'=>'https://www.youtube.com/','type'=>'text','required']);?>
                                    </div>
                                </div>
                                <div class="row" style="padding-top:5px">
                                    <div class="col-md-6">
                                        <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('description',[
                                        'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>2,'required']);?>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="control-label"> Shareable</label>
                                         <?= $this->Form->control('shareable', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','value'=>1])?>
                                    </div>
                                </div>
 
                                <div class="box-footer">
                                    <div class="row">
                                        <center>
                                            <div class="col-md-12">
                                                <div class="col-md-offset-3 col-md-6">  
                                                    <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member','name'=>'newGallery']); ?>
                                                </div>
                                            </div>
                                        </center>       
                                    </div>
                                </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>

                        
                </div>
            </div>
        </div>
    </div>
</div>
 

<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('timepicker') ?> 
<?= $this->element('icheck') ?> 
<?php
$js='
$(document).ready(function() { 
     
    // validate signup form on keyup and submit
     $("#ServiceForm").validate({ 
        rules: {
            description: {
                required: true
            },
            academic_category_id: {
                required: true
            },
            date: {
                required: true
            }
        },
        submitHandler: function () {
            $("#submit_member").attr("disabled","disabled");
            form.submit();
        }
    }); 
    $("#ServiceForms").validate({ 
        rules: {
            description: {
                required: true
            },
            academic_category_id: {
                required: true
            },
            date: {
                required: true
            }
        },
        submitHandler: function () {
            $("#submit_member").attr("disabled","disabled");
            form.submit();
        }
    }); 
});
    
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 
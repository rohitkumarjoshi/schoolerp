
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > News Edit </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($gallery,['id'=>'ServiceForm','type'=>'file']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Select Role <span class="required" aria-required="true"> * </span></label>
                                <?php $type['All']='All';?>
                                <?php $type['Teacher']='Teacher';?>
                                <?php $type['Student']='Student';?>
                                <?php echo $this->Form->control('role_type',[
                                'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $type,'required'=>true]);?>
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('title',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Title','type'=>'text','required']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('date_from',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required']);?>
                            </div>  
                        </div>
                        
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Cover Image </label>
                                <?php echo $this->Form->control('cover_image',[
                                'label' => false,'class'=>'','placeholder'=>'Date','type'=>'file']);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('description',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>2,'required']);?>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> Shareable</label>
                                 <?= $this->Form->control('shareable', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','value'=>1])?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Status </label>
                                <div class="form-group">
                                    <?php 
                                        $status[]=['value'=>'N','text'=>'Active'];
                                        $status[]=['value'=>'Y','text'=>'Deactive'];
                                    ?>
                                    <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'form-control','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                            </div>
                        </div>
                         <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
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

 

<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?> 
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
});

 
    
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 
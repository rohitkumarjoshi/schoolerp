
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Academic Calendar </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($academicCalender,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Select Category <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('academic_category_id',[
                                'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $academicCategories,'required'=>true]);?>
                            </div> 
                            <div class="col-md-6">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('date',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Status <span class="required" aria-required="true"> * </span></label>
                                <?php 
                                    $status[]=['value'=>'N','text'=>'Active'];
                                    $status[]=['value'=>'Y','text'=>'Deactive'];
                                ?>
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2 form-control','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                            <div class="col-md-8">
                                <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('description',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>2]);?>
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
 
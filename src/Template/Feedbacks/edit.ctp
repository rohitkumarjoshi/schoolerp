<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <label> Add Feedback </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($feedback,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Mobile No <span class="required" aria-required="true"> * </span></label>
                                 <!--  <?php //echo $this->Form->control('mobile_no',[
                                    //'label' => false,'class'=>'form-control ','placeholder'=>'Enter Mobile Number','type'=>'text','required']);?> -->

                                    <input class="form-control " type="text" maxlength="10" minlength="10" name="mobile_no" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $feedback->mobile_no ?>" autocomplete="off" required>
                            </div>
                        </div>
                         <span class="help-block"></span>
                         <div class="row">
                             <div class="col-md-8">
                                <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                                  <?php echo $this->Form->control('description',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter description here','type'=>'textarea','required','rows'=>5]);?>
                            </div>
                        </div>
                    <span class="help-block"></span>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status </label>
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                    <span class="help-block"></span>
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
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
        $('#ServiceForm').validate({ 
        rules: {
            mobile_no: {
                required: true
            }
            description: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
        });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>

